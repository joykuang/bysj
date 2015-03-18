uniform sampler2D texture;
uniform sampler2D patterns;
uniform sampler2D normalMap;
uniform float opacity;

varying vec3 vColor;
varying float vIntensity;
varying float vPattern;

varying vec3 vDelta;

void main() {

    vec4 normal = texture2D( normalMap, gl_PointCoord );
    vec4 texel = texture2D( texture, gl_PointCoord );
    vec4 patternTexel = texture2D( patterns, gl_PointCoord );

    if ( texel.w < 0.1 ) {
        discard;
    }

    float dotProd = max( dot( normalize( vDelta ), normalize( normal.xyz ) ), 0.0 );
    float dist = length( vDelta );

    gl_FragColor = vec4( vColor * texel.x, texel.w );

    float patternBrightness = 1.0;

    float p = ceil( vPattern );
    if ( p <= 1.0 ) {
        // gl_FragColor.xyz *= 1.0 - patternTexel.z;
    } else if ( p >= 2.0 && p <= 3.0 ) {
        gl_FragColor.xyz +=  patternTexel.x;
    } else if ( p >= 4.0 && p <= 5.0 ) {
        gl_FragColor.xyz  +=  patternTexel.y;
    } else if ( p >= 6.0 && p <= 7.0 ) {
        gl_FragColor.xyz +=  patternTexel.z;
    }


    gl_FragColor.xyz += texel.y * texel.y * 2.0;

    float shadow = dotProd * vIntensity * 3.0;
    shadow = clamp( pow( shadow, 1.0 ), 0.0, 1.0 );
    shadow *= 0.4;
    shadow += 1.0;

    gl_FragColor.xyz *= min( shadow, 1.0 );


    float gradient = max( pow( vIntensity, 5.0 ) * dotProd, 0.0 );
    // gradient *= 0.15;
    // gradient += 0.85;

    // gl_FragColor.xyz *= gradient;
    
    if ( dist < 70.0 * dotProd ) {
        gl_FragColor.xyz += vec3( dotProd * ( 0.75 - dist * 0.002 ) ) * texel.x;
    }

}

// rotate sprite

// // Set a center position.
// highp vec2 center = vec2(0.5, 0.5);

// // Translate the center of the point the origin.
// highp vec2 centeredPoint = gl_PointCoord - center;

// // Create a rotation matrix using the provided angle
// highp mat2 rotation = mat2(cos(vRotation), sin(vRotation),
//                           -sin(vRotation), cos(vRotation)); 

// // Perform the rotation.
// centeredPoint = rotation * centeredPoint;

// // Translate the point back to its original position and use that point 
// // to get your texture color.
// gl_FragColor = texture2D(uTexture, centeredPoint + center);