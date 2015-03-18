uniform float scale;
uniform vec2 screenSize;
uniform vec3 light;

attribute float size;
attribute vec3 color;
varying vec3 vColor;

// varying mat3 vNormalMatrix;
// varying mat4 vRotationMatrix;

attribute float pattern;
varying float vPattern;

varying vec3 vDelta;
varying float vIntensity;

void main() {

    vec4 mvPosition = modelViewMatrix * vec4( position, 1.0 );
    vec4 worldPosition = modelMatrix * vec4( position, 1.0 );

    vColor = color;
    vPattern = pattern;
    vDelta = light - worldPosition.xyz;
    vIntensity = max( 1.0 - length( vDelta ) * 0.01, 0.0 );
    // vNormalMatrix = normalMatrix;

    // float a_angle = atan( -vDelta.y, vDelta.x );

    // float c = cos(a_angle);
    // float s = sin(a_angle);

    // mat4 transInMat = mat4(1.0, 0.0, 0.0, 0.0,
    //                        0.0, 1.0, 0.0, 0.0,
    //                        0.0, 0.0, 1.0, 0.0,
    //                        0.5, 0.5, 0.0, 1.0);
    // mat4 rotMat = mat4(c, -s, 0.0, 0.0,
    //                    s, c, 0.0, 0.0,
    //                    0.0, 0.0, 1.0, 0.0,
    //                    0.0, 0.0, 0.0, 1.0);
    // mat4 resultMat = transInMat * rotMat;
    // resultMat[3][0] = resultMat[3][0] + resultMat[0][0] * -0.5 + resultMat[1][0] * -0.5;
    // resultMat[3][1] = resultMat[3][1] + resultMat[0][1] * -0.5 + resultMat[1][1] * -0.5;
    // resultMat[3][2] = resultMat[3][2] + resultMat[0][2] * -0.5 + resultMat[1][2] * -0.5;

    // vRotationMatrix = resultMat;

    gl_PointSize = screenSize.x * scale * size * ( 0.75 / length( mvPosition.xyz ) );
    gl_Position = projectionMatrix * mvPosition;

}