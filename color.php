
<?php include "include/gamenav.php"; ?>
<script type="text/paperscript" canvas="myCanvas">

var keyData = {
      å: {
 sound: new Howl({
   src: ['sound/bubbles.mp3']
 }),
 color: '#134c9c'
 },
     æ: {
sound: new Howl({
  src: ['sound/bubbles.mp3']
}),
color: '#1ab1ec'
},
     ø: {
sound: new Howl({
  src: ['sound/clay.mp3']
}),
color: '#1a0c9c'
},
 q: {
 sound: new Howl({
   src: ['sound/bubbles.mp3']
 }),
 color: '#1abc9c'
 },
 w: {
 sound: new Howl({
   src: ['sound/clay.mp3']
 }),
 color: '#2ecc71'
 },
 e: {
 sound: new Howl({
   src: ['sound/confetti.mp3']
 }),
 color: '#3498db'
 },
 r: {
 sound: new Howl({
   src: ['sound/corona.mp3']
 }),
 color: '#9b59b6'
 },
 t: {
 sound: new Howl({
   src: ['sound/dotted-spiral.mp3']
 }),
 color: '#34495e'
 },
 y: {
 sound: new Howl({
   src: ['sound/flash-1.mp3']
 }),
 color: '#16a085'
 },
 u: {
 sound: new Howl({
   src: ['sound/flash-2.mp3']
 }),
 color: '#27ae60'
 },
 i: {
 sound: new Howl({
   src: ['sound/flash-3.mp3']
 }),
 color: '#2980b9'
 },
 o: {
 sound: new Howl({
 src: ['sound/glimmer.mp3']
 }),
 color: '#8e44ad'
 },
 p: {
 sound: new Howl({
   src: ['sound/moon.mp3']
 }),
 color: '#2c3e50'
 },
 a: {
 sound: new Howl({
   src: ['sound/pinwheel.mp3']
 }),
 color: '#f1c40f'
 },
 s: {
 sound: new Howl({
   src: ['sound/piston-1.mp3']
 }),
 color: '#e67e22'
 },
 d: {
 sound: new Howl({
   src: ['sound/piston-2.mp3']
 }),
 color: '#e74c3c'
 },
 f: {
 sound: new Howl({
   src: ['sound/prism-1.mp3']
 }),
 color: '#95a5a6'
 },
 g: {
 sound: new Howl({
   src: ['sound/prism-2.mp3']
 }),
 color: '#f39c12'
 },
 h: {
 sound: new Howl({
   src: ['sound/prism-3.mp3']
 }),
 color: '#d35400'
 },
 j: {
 sound: new Howl({
   src: ['sound/splits.mp3']
 }),
 color: '#1abc9c'
 },
 k: {
 sound: new Howl({
   src: ['sound/squiggle.mp3']
 }),
 color: '#2ecc71'
 },
 l: {
 sound: new Howl({
   src: ['sound/strike.mp3']
 }),
 color: '#3498db'
 },
 z: {
 sound: new Howl({
   src: ['sound/suspension.mp3']
 }),
 color: '#9b59b6'
 },
 x: {
 sound: new Howl({
   src: ['sound/timer.mp3']
 }),
 color: '#34495e'
 },
 c: {
 sound: new Howl({
   src: ['sound/ufo.mp3']
 }),
 color: '#16a085'
 },
 v: {
 sound: new Howl({
   src: ['sound/veil.mp3']
 }),
 color: '#27ae60'
 },
 b: {
 sound: new Howl({
   src: ['sound/wipe.mp3']
 }),
 color: '#2980b9'
 },
 n: {
 sound: new Howl({
 src: ['sound/zig-zag.mp3']
 }),
 color: '#8e44ad'
 },
 m: {
 sound: new Howl({
   src: ['sound/moon.mp3']
 }),
 color: '#2c3e50'
 }
 }

          var circles= [];

          function onKeyDown(event){
             if(keyData[event.key]){

             var maxPoint = new Point(view.size.width, view.size.height);
             var randomPoint = Point.random();
             var point = maxPoint * randomPoint;
             var newCircle = new Path.Circle(point, 500);
             newCircle.fillColor= "orange";
             newCircle.fillColor = keyData[event.key].color;
             keyData[event.key].sound.play();
             circles.push(newCircle);
               }
             }


          function onFrame(event){
             for(var i = 0; i< circles.length; i++){
                             
            circles[i].scale(0.9);

             circles[i].fillColor.hue+=1;
    if(circles[i].area<1){
    circles[i].remove();
    circles.splice(i, 1);
    i--;
    console.log(circles);
    }
             }


             }


</script>
    <canvas id="myCanvas" resize></canvas>
</div>

<?php include "include/footer.php"; ?>