// Enemies.js
export default class Enemies {
  constructor(scene) {
    this.scene = scene;
    this.enemiesGroup = this.scene.physics.add.group();
    this.scene.isDataSaved = false;
  }

  preload() {
    this.scene.load.spritesheet("enemy1", "./img/sources/enemy_1/enemy_1.png", {
      frameWidth: 600,
      frameHeight: 900,
    });
    this.scene.load.spritesheet("enemy2", "./img/sources/enemy_2/enemy_2.png", {
      frameWidth: 700,
      frameHeight: 700,
    });
    this.scene.load.spritesheet("enemy3", "./img/sources/enemy_3/enemy_3.png", {
      frameWidth: 500,
      frameHeight: 500,
    });
  }

  create(enemiesData, platformsGroup, layer2, player) {
    enemiesData.forEach((enemy) => {
      const newEnemy = this.enemiesGroup
        .create(enemy.x, enemy.y, enemy.key)
        .setScale(0.3)
        .setCollideWorldBounds(true);

      this.scene.physics.add.collider(newEnemy, platformsGroup);
      this.scene.physics.add.collider(newEnemy, layer2);
      this.scene.physics.add.overlap(
        player,
        newEnemy,
        this.scene.hitEnemies,
        null,
        this.scene
      );
      const randomDirection = Math.floor(Math.random() * 2);
      newEnemy.setVelocityX(randomDirection === 1 ? 100 : -100);
      this.createAnimations(enemy.key);
      newEnemy.anims.play(enemy.key);
      newEnemy.direction = randomDirection === 1 ? "right" : "left";
    });
  }

  createAnimations(key) {
    if (!this.scene.anims.exists(key)) {
      this.scene.anims.create({
        key,
        frames: this.scene.anims.generateFrameNumbers(key, {
          start: 0,
          end: 7,
        }),
        frameRate: 8,
        repeat: -1,
      });
    }
  }

  update() {
    this.enemiesGroup.getChildren().forEach((enemy) => {
      if (enemy.body.blocked.left) {
        enemy.setVelocityX(100);
        enemy.direction = "right";
      } else if (enemy.body.blocked.right) {
        enemy.setVelocityX(-100);
        enemy.direction = "left";
      }
    });
  }

  hitEnemies = async function (player, enemy) {
    if (this.scene.isInvulnerable) return;

    if (this.scene.lives === 1) {
      this.scene.scene.stop();
      if (!this.scene.isDataSaved) {
        await this.saveData("No", this.scene.currentLevel);
        this.scene.isDataSaved = true;
    }
      window.location.href = "gameOver.html";
    } else {
      this.scene.lives -= 1;
      this.updateLivesText(this.scene);
      this.scene.isInvulnerable = true;
      player.setTint(0x718994);
      this.scene.time.addEvent({
        delay: 1000,
        callback: () => {
          player.clearTint();
          this.scene.isInvulnerable = false;
        },
      });
    }
  };

  updateLivesText(scene) {
    const livesTextElement = document.getElementById("livesText");
    if (livesTextElement) {
      livesTextElement.textContent = `Lives: ${this.scene.lives}`;
    }
  }

  saveData(hasClosed, level) {
    fetch("http://localhost/codigoNuria/tracking.php", {
      method: "POST",
      mode: "same-origin",
      credentials: "same-origin",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        browser: navigator.userAgent,
        screen: screen.width + "x" + screen.height,
        length: this.scene.totalSessionTime,
        level: level,
        closed: hasClosed,
        score: this.scene.score,
      }),
      keepalive: true,
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
      })
      .catch((error) => {
        console.error("Error al guardar datos:", error);
      });
  }
}
