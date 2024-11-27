import player from "./player.js";
export default class Transformation {
    constructor(scene) {
      this.scene = scene;
      this.bear = null;
      this.player = player;
    }
  
    preload() {
      this.scene.load.spritesheet("bearIdle", "../img/sources/bear/idle.png", {
        frameWidth: 800,
        frameHeight: 450,
      });
      this.scene.load.spritesheet("bearRun", "../img/sources/bear/run.png", {
        frameWidth: 875,
        frameHeight: 500,
      });
      this.scene.load.spritesheet("bearAttack", "../img/sources/bear/attack.png", {
        frameWidth: 1150,
        frameHeight: 700,
      });
    }
  
    create(player) {
      this.bear = this.scene.physics.add.sprite(this.player.x, this.player.y, "bearIdle")
        .setScale(0.4)
        .setVisible(false);  
  
      this.createAnimations();
    }
  
    createAnimations() {
      this.scene.anims.create({
        key: "bearIdle",
        frames: this.scene.anims.generateFrameNumbers("bearIdle", { start: 0, end: 3 }),
        frameRate: 4,
        repeat: -1,
      });
  
      this.scene.anims.create({
        key: "bearRun",
        frames: this.scene.anims.generateFrameNumbers("bearRun", { start: 0, end: 7 }),
        frameRate: 8,
        repeat: -1,
      });
  
      this.scene.anims.create({
        key: "bearAttack",
        frames: this.scene.anims.generateFrameNumbers("bearAttack", { start: 0, end: 5 }),
        frameRate: 10,
        repeat: 0,
      });
    }

    startTransformation() {
      if (this.player && this.bear) {
      this.player.sprite.setVisible(false); // Oculta al player original
      this.bear.setVisible(true); // Muestra la transformación (bear)
      this.bear.setPosition(this.player.sprite.x, this.player.sprite.y); // Posiciona la transformación en la ubicación del player
      this.bear.play("bearIdle"); // Inicia la animación
    } else {
      console.error("Error: player o bear no están inicializados");
    }
    }
  
    endTransformation() {
      this.bear.setVisible(false); // Oculta la máscara
      this.player.setVisible(true); // Vuelve a mostrar al player
    }
  
    update() {
      if (this.bear && this.bear.visible) {
        // Si la máscara está activa, sigue la posición del player
        this.bear.x = this.player.x;
        this.bear.y = this.player.y;
      }
    }
  }
  