import GameScene from './game.js';

let config = {
    type: Phaser.AUTO,
    width: window.innerWidth,
    height: window.innerHeight,
    debug: false,
    scene: [GameScene],
    physics: {
      default: "arcade",
      arcade: {
        gravity: { y: 1400 },
        debug: false,
      },
    },
    scale: {
      mode: Phaser.Scale.RESIZE,
      autoCenter: Phaser.Scale.CENTER_BOTH,
    },
  };
  
  let game = new Phaser.Game(config);
  window.addEventListener("resize", () => {
    game.scale.resize(window.innerWidth, window.innerHeight);
  });