
var domExperiment     = document.getElementById('experiment-container');
var domContainer      = document.getElementById('container');
var domTitle          = document.getElementById('ex-title');
var domLocation       = document.getElementById('ex-location');
var domAuthor         = document.getElementById('ex-author');
var domDate           = document.getElementById('ex-date');
var domIndex          = document.getElementById('ex-index');
var domTags           = document.getElementById('ex-tags');
var domImage          = document.getElementById('ex-image');
var domImageContainer = document.getElementById('ex-image-container');
var domFilters        = document.getElementById('filters');
var domFilterTab      = document.getElementById('filter-tab');
var domFilterWebGL    = document.getElementById('filter-webgl');
var domFilterNotWebGL = document.getElementById('filter-notwebgl');
var domChrono         = document.getElementById('filter-chrono');
var domCopy           = document.getElementById('copy');
var canvas            = document.getElementById('canvas');

var loaded = _.after(4, init);

var experiments;
var positions;
var tags;

var prevClosest; // prev hovering exp
var closest; // hovering exp
var overCanvas = false;

var first; // date of earliest exp
var last; // date of latest exp
var realDur; // last - first
var dur = 3000; // duration of appear

var restDrag = 0;
var chronoDrag = 0.2;

var frame = 0;
var ctx = canvas.getContext('2d');
var physics = new ParticleSystem(0, 0, 0, restDrag);
var started;
var mouseParticle;
var mouseThresh = 50;

var restRepulsion = -1;

var restConstant = 0.01;
var restDamping = 0.9;

var maxHeight = 400;
var maxScale = 1.85;
var scale = maxScale;

var textWidth = 498;
var textHeight = 260;

var isChrono = false;

var mouseMoved = false;
var allAdded = false;

var hasHover = !navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry)/);

var banner;
var bannerImage = document.getElementById('banner');

var activeFilter;

var sfx = new SFX(loaded);

$.getJSON('/500/data/experiments.js', function(data) {
  experiments = data;
  loaded();
});

$.getJSON('/500/data/positions.js', function(data) {
  positions = data;
  loaded();
});

$.getJSON('/500/data/tags.js', function(data) {
  tags = data;
  var domTags = document.getElementById('filters')

  _.each(tags, function(t, k) {
    var li = document.createElement('span');
    li.filter = function(p) {
     return p.data.tags.indexOf(k) != -1;
    };
    li.filter.tag = k;
    li.innerHTML = k.replace(' ', '&nbsp;');
    if (t[1]) {
      li.classList.add('invert');
    }
    li.addEventListener('click', setFilter, false);
    domTags.insertBefore(li, domTags.lastElementChild);
  });


  loaded();

});

function init() {

  mouseParticle = physics.makeParticle(200, 0, 0, 0);
  mouseParticle.makeFixed();

  window.addEventListener('mousedown', onMouseDown, false);
  window.addEventListener('mousemove', onMouseMove, false);
  window.addEventListener('click', onClick, false);

  domContainer.addEventListener('mousemove', function() {
    mouseMoved = true;
    overCanvas = true;
  }, false);

  domContainer.addEventListener('mouseout', function() {
    overCanvas = false;
  }, false); 

  domExperiment.addEventListener('mousemove', function() {
    overCanvas = true;
  }, false);

  domExperiment.addEventListener('mouseout', function() {
    overCanvas = false;
  }, false); 

  domFilters.addEventListener('mouseover', function(e) {
    e.stopPropagation();
    overCanvas = false;
    return false;
  }, false);

  domFilters.addEventListener('mousemove', function(e) {
    e.stopPropagation();
    overCanvas = false;
    return false;
  }, false);


  domFilterTab.addEventListener('click', function() {
    if (!allAdded) return;
    domFilters.classList.toggle('showing');
    domFilterTab.classList.toggle('showing');
    if (!domFilters.classList.contains('showing')) {
      // clearFilter();
    }
  }, false);

  domChrono.addEventListener('click', chrono, false);

  domFilterWebGL.filter = function(p) { return p.data.webgl };
  domFilterNotWebGL.filter = function(p) { return !p.data.webgl };

  domFilterWebGL.addEventListener('click', setFilter, false);
  domFilterNotWebGL.addEventListener('click', setFilter, false);

  first = experiments[0].date;
  last = experiments[experiments.length-1].date;

  var firstDate = new Date(experiments[0].date);
  firstMonth = firstDate.getFullYear()*12+firstDate.getMonth();

  realDur = last - first;

  started = Date.now();  

  _.each(experiments, function(e, i) {
    var ep = new ExperimentParticle(e, positions[i]);
  });

  window.addEventListener('resize', onResize, false);
  onResize();

  update();

}

function update() {
  
  frame++;

  requestAnimationFrame(update);

  ctx.globalAlpha = 0.25;
  
  ctx.fillRect(0, 0, canvas.width, canvas.height);

  ctx.globalAlpha = 1;
  ctx.save();
  ctx.translate(canvas.width/2, canvas.height/2)
  ctx.scale(scale, scale);
  ctx.translate(-textWidth/2, -textHeight/2);

  physics.tick();

  closest = null;

  if (overCanvas && allAdded && mouseMoved) {

    var closestD = mouseThresh*mouseThresh;
    _.each(ExperimentParticle.all, function(p) {
      var d = p.distanceSquaredToMouse();
      if (d < closestD) {
        closestD = d;
        closest = p;
      }
    });
  }

  if (closest != prevClosest) {
    if (prevClosest) {
      prevClosest.mouseOut();
    }
    if (closest) {
      closest.mouseOver();
    }
  }

  prevClosest = closest;

  if (closest) {
    closest.update(Date.now() - started)
    closest.draw()
  }

  _.each(ExperimentParticle.all, function(p) {
    if (p == closest) return;
    p.update(Date.now() - started);
    p.draw();
  });

  ctx.restore();
  // banner.update();

}

function onAllAdded() {
  allAdded = true;
  domCopy.classList.add('showing');
}

function setFilter() {
  var isNew = this.filter != activeFilter;
  clearFilter();
  if (isNew) {
    filter(this.filter);
    if (this.filter.tag) {
      this.style.backgroundColor = tags[this.filter.tag][0];
    }
    this.classList.add('selected');
  }
}

function chrono() {
  isChrono = !isChrono;
  if (isChrono) {
    domChrono.classList.add('selected');
    _.each(ExperimentParticle.all, function(p) {
      p.chrono();
    });
    physics.drag = chronoDrag;
  } else {
    domChrono.classList.remove('selected');
    _.each(ExperimentParticle.all, function(p) {
      p.unchrono();
    });
    physics.drag = restDrag;
  }
}

function filter(match) {
  activeFilter = match;
  _.each(ExperimentParticle.all, function(p) {
    if (match(p)) {
      p.solo();
    } else {
      p.unsolo();
    }
  });
}

function clearFilter() {
  activeFilter = false;
  _.each(domFilters.children, function(c) {
    if (c != domChrono) {
      c.classList.remove('selected');
      c.style.backgroundColor = '';
    }
  });
  _.each(ExperimentParticle.all, function(p) {
    p.unsolo();
  });
}

function onMouseMove(e) {
  mouseParticle.position.x = (e.clientX - canvas.width/2)/scale + textWidth/2;
  mouseParticle.position.y = (e.clientY - canvas.height/2)/scale + textHeight/2;
}

function onResize() {

  var r = (canvas.parentElement || canvas.parentNode).getBoundingClientRect();
  var h = r.height;
  var h2 = h - 100;
  var w = r.width;
  var w2 = w - 100;

  if (textHeight * maxScale > h2 || textWidth * maxScale > w2) {
    scale = Math.min(w2/textWidth,  h2/textHeight);
  } else {
    scale = maxScale;
  }

  canvas.width = w;
  canvas.height = h;

  var m = Math.min(textHeight*scale/2.3, 170);

  domCopy.style.marginTop = m + 'px';
  
  ctx.fillStyle = getComputedStyle(document.body,null).getPropertyValue('background-color');

  ctx.font = "700 30px 'Istok Web', sans-serif";
  ctx.textBaseline = 'middle';
  ctx.textAlign = 'center';
}

function onMouseDown(e) {
  e.preventDefault();
  return false;
}

function onClick(e) {
  // e.preventDefault();
  if (closest) closest.click();
  // return false;
}