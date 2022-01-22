const strands = Array.from(document.querySelectorAll('#banner'));
const duration = 6000;
const supportsOffsetPath = 
        window.CSS
        && CSS.supports
        && CSS.supports('offset-path', "path('M0,0 L1,1')");
const rxRandomNegative = -5;
const rxRandomNegativeBase = -7.5;
const rxRandomPositive = 15;
const rxRandomPositiveBase = 7.5;


if (document.documentElement.animate) {
  strands.forEach(animateStrands);
}


function animateStrands(strand) {
  let flags = Array.from(strand.querySelectorAll('.flag'));
  let strandPathDuration = Math.random() * (2 * duration) + duration;
  let fromPath = "path('M0,-20 C0,10 800,-50 800,-10')";
  let toPath = `path('M0,-20 C0,${Math.random() * 5} ${Math.random() * -50 + 500},${Math.random() * 20} 800,-15')`;

  flags.forEach((flag, i) => {
    flag.style.offsetDistance = `${80 + i * 750 / flags.length}px`;
    animateWindRotate(flag);
    animateWindCurve(flag, fromPath, toPath, strandPathDuration);
  });

  if (supportsOffsetPath) {
    // animateStringInWind(strand, fromPath, toPath, strandPathDuration);
  }
}

function animateWindRotate(flag) {
  flag.animate(getRandomizedFlagFrames(), {
    duration: duration,
    iterations: Infinity,
    direction: 'alternate',
    delay: 1000 * Math.random() - 1000
  });
}
function animateWindCurve(flag, fromPath, toPath, strandPathDuration) {
  flag.animate([
    {offsetPath: fromPath},
    {offsetPath: toPath}
  ], {
    duration: strandPathDuration,
    iterations: Infinity,
    easing: 'ease-in-out',
    direction: 'alternate'
  });
}
// function animateStringInWind(strand, fromPath, toPath, strandPathDuration) {
//   let stringy = strand.querySelector('.string path');
//   if (stringy) {
//     stringy.animate([
//       {d: fromPath},
//       {d: toPath}
//     ], {
//       duration: strandPathDuration,
//       iterations: Infinity,
//       easing: 'ease-in-out',
//       direction: 'alternate'
//     });
//   }
// }




function getRandomizedFlagFrames() {
    let easing1 = `cubic-bezier(${Math.random() * .1 + .3},0,${Math.random() * .1 + .3},${Math.random() * .15 + .95})`;
    let easing2 = `cubic-bezier(${Math.random() * .1 + .3},0,${Math.random() * .1 + .3},${Math.random() * .15 + .95})`
  return [
      { 
        transform: 'rotateX(0deg)',
        filter: 'grayscale(5%)'
      }, { 
        transform: `rotateX(${Math.random() * rxRandomNegative + rxRandomNegativeBase}deg)`,
        filter: 'grayscale(25%)', //shadows for when rotating away from you
        easing: easing1
      }, {
        transform: `rotateX(${Math.random() * rxRandomPositive + rxRandomPositiveBase}deg)`,
        filter: 'grayscale(0%)',
        easing: easing1
      }, {
        transform: `rotateX(${Math.random() * rxRandomNegative + rxRandomNegativeBase}deg)`,
        filter: 'grayscale(25%)',
        easing: easing2
      }, {
        transform: `rotateX(${Math.random() * rxRandomPositive + rxRandomPositiveBase}deg)`,
        filter: 'grayscale(0%)',
        easing: easing2
      }
    ]
}
// function showNav(){

//   document.getElementById('toggle').onclick=burger;
// }
// function burger(){
  
 
//   if(document.getElementsByClassName('getCoupon')[0].style.display="block"){
//     document.getElementsByClassName('getCoupon')[0].style.display="none";
//   }else{
//     document.getElementsByClassName('getCoupon')[0].style.display="block";
//   }
// }

// window.addEventListener("load",showNav,false);