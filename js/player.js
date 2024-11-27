//Codigo de ia//
//Ia utilizada: chatGPT//
//Promp utilizado: Quiero que la hitbox del personaje sea mas justa cuando salta y esta estatico.//
const PLAYER_DIMENSIONS = {
    walk: [240, 380],
  idle: [140, 380],
  jump: [140, 380],
  };
  const PLAYER_SCALE = 0.7;
  
  export default class Player {
    constructor(scene) {
      this.scene = scene;
      this.player = null;
      this.isJumping = false;
      this.playerSpeed = 300;
      this.playerJump = -880;
    }
  
    preload() {
      this.scene.load.spritesheet("playerIdle", "./img/sources/character/idle.png", { frameWidth: 109, frameHeight: 275 });
      this.scene.load.spritesheet("playerWalk", "./img/sources/character/walk.png", { frameWidth: 149, frameHeight: 275 });
      this.scene.load.spritesheet("playerJump", "./img/sources/character/jump.png", { frameWidth: 176, frameHeight: 275 });
    }
  
    create(playerData, platformsGroup, layer2, enemiesGroup, giftsGroup) {
      const player = this.player = this.scene.physics.add
        .sprite(playerData.x, playerData.y, playerData.key)
        .setScale(PLAYER_SCALE)
        .setCollideWorldBounds(true);
  
      this.createAnimations();

      this.scene.physics.add.collider(player, layer2);
      this.scene.physics.add.collider(player, platformsGroup);
      this.scene.physics.add.overlap(player, enemiesGroup.enemiesGroup, enemiesGroup.hitEnemies, null, enemiesGroup);
      this.scene.physics.add.overlap(player, giftsGroup.giftsGroup, giftsGroup.collectGifts, null, giftsGroup);
    }
  
    createAnimations() {
      if(!this.scene.anims.exists("walk")) {
        this.scene.anims.create({
          key: "walk",
          frames: this.scene.anims.generateFrameNumbers("playerWalk", { start: 0, end: 7 }),
          frameRate: 8,
          repeat: -1,
        });
      }
  
      if(!this.scene.anims.exists("idle")) {
        this.scene.anims.create({
          key: "idle",
          frames: this.scene.anims.generateFrameNumbers("playerIdle", { start: 0, end: 3 }),
          frameRate: 4,
          repeat: -1,
        });
      }
  
      if(!this.scene.anims.exists("jump")) {
        this.scene.anims.create({
          key: "jump",
          frames: this.scene.anims.generateFrameNumbers("playerJump", { start: 0, end: 6 }),
          frameRate: 6.5,
          repeat: 0,
        });
      }
    }
  
    updateHitbox() {
      const currentAnimKey = this.player.anims.currentAnim ? this.player.anims.currentAnim.key : "idle";
  
      //continuacion del codigo de ia de la hitbox//
      let width, height;
      switch (currentAnimKey) {
        case "walk":
          [width, height] = PLAYER_DIMENSIONS.walk;
          break;
        case "idle":
          [width, height] = PLAYER_DIMENSIONS.idle;
          break;
        case "jump":
          [width, height] = PLAYER_DIMENSIONS.jump;
          break;
        default:
          [width, height] = PLAYER_DIMENSIONS.idle;
      }
  
      this.player.body.setSize(width * PLAYER_SCALE, height * PLAYER_SCALE);
      this.player.body.setOffset(
        (this.player.width - width * PLAYER_SCALE) / 2,
        (this.player.height - height * PLAYER_SCALE) / 2
      );
    }
  
    update(controls) {
      if (!controls) return;
  
      if (controls.left.isDown) {
        this.player.setVelocityX(-this.playerSpeed);
        this.player.flipX = true;
        if (!this.isJumping && (!this.player.anims.isPlaying || this.player.anims.currentAnim.key !== "walk")) {
          this.player.anims.play("walk");
          this.updateHitbox();
        }
      } else if (controls.right.isDown) {
        this.player.setVelocityX(this.playerSpeed);
        this.player.flipX = false;
        if (!this.isJumping && (!this.player.anims.isPlaying || this.player.anims.currentAnim.key !== "walk")) {
          this.player.anims.play("walk");
          this.updateHitbox();
        }
      } else {
        this.player.setVelocityX(0);
        if (!this.isJumping && (!this.player.anims.isPlaying || this.player.anims.currentAnim.key !== "idle")) {
          this.player.anims.play("idle");
          this.updateHitbox();
        }
      }
  
      if (controls.up.isDown && !this.isJumping) {
        this.player.setVelocityY(this.playerJump);
        this.player.anims.play("jump");
        this.updateHitbox();
        this.isJumping = true;
      }
  
      //no es ia, pero me tuve que ver muchos videos y buscar en el phaser para que funcione//
      if (this.player.body.touching.down || this.player.body.blocked.down) {
        if (this.isJumping) {
          this.isJumping = false;
          if (this.player.body.velocity.x === 0) {
            this.player.anims.play("idle");
            this.updateHitbox();
          } else {
            this.player.anims.play("walk");
            this.updateHitbox();
          }
        }
      }
    }
  }
  