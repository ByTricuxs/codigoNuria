// Game.js
import controls from "./controls.js";
import orientationManager from "./orientationManager.js";
import background from "./background.js";
import player from "./player.js";
import enemies from "./enemies.js";
import gifts from "./gifts.js";
import platforms from "./platforms.js";

const WORLD_BOUNDS = { width: 5714, height: 1000 };
const ZOOM_FACTOR = 1;
const MAX_LEVELS = 3;

class GameScene extends Phaser.Scene {
  constructor() {
    super("GameScene");
    this.currentLevel = 1;
    this.score = 0;
    this.totalSessionTime = 0;
    this.startTime = null;
  }

  init() {
    this.lives = 3;
    this.coinsCount = 0;
    this.isInvulnerable = false;
    this.length = 0;
    this.timer = null;
  }

  loadLevelData = async function () {
    const response = await fetch(
      `http://localhost/codigonuria/editor/api.php?id=${this.currentLevel}`
    );
    const levelData = await response.json();
    return levelData;
  };

  preload() {
    this.controls = new controls(this);
    this.orientationManager = new orientationManager(this);
    this.background = new background(this);
    this.player = new player(this);
    this.enemies = new enemies(this);
    this.gifts = new gifts(this);
    this.platforms = new platforms(this);

    this.controls.preload();
    this.orientationManager.create();
    this.background.preload();
    this.player.preload();
    this.enemies.preload();
    this.gifts.preload();
    this.platforms.preload();
  }

  create = async function () {
    window.addEventListener("beforeunload", (event) => {
      if (!this.isDataSaved) {
        this.saveData("Yes", this.currentLevel);
        this.isDataSaved = true;
      }
    });

    this.isLevelComplete = false;
    const orientation =
      screen.orientation || screen.mozOrientation || screen.msOrientation;
    if (orientation.type.includes("portrait")) {const orientationMessage = document.getElementById("orientationMessage");
    if (orientationMessage) {
      orientationMessage.classList.remove("hidden");
    orientationMessage.classList.add("visible");
      }
      this.scene.pause("GameScene");
    }

    const pauseButton = document.getElementById("hudButton");
  if (pauseButton) {
    pauseButton.addEventListener("click", () => {
      if (this.scene.isPaused()) {
        this.scene.resume("GameScene");
        const pauseMessage = document.getElementById("pauseMessage");
        if (pauseMessage) {
          pauseMessage.classList.remove("visible");
        }
      } else {
        this.scene.pause("GameScene");
        const pauseMessage = document.getElementById("pauseMessage");
        if (pauseMessage) {
          pauseMessage.classList.add("visible");
        }
      }
    });
  }

    const levelData = await this.loadLevelData();

    this.controls.create();
    this.background.create(levelData.backgroundLayers);
    this.platforms.create(levelData.platforms);
    this.player.create(
      levelData.player,
      this.platforms.group,
      this.layer2,
      this.enemies,
      this.gifts
    );
    this.enemies.create(
      levelData.enemies,
      this.platforms.group,
      this.layer2,
      this.player
    );
    this.gifts.create(levelData.gifts, this.player);

    this.physics.world.setBounds(0, 0, WORLD_BOUNDS.width, WORLD_BOUNDS.height);
    this.cameras.main.setBounds(0, 0, WORLD_BOUNDS.width, WORLD_BOUNDS.height);
    this.cameras.main.startFollow(this.player.player);
    this.cameras.main.setZoom(ZOOM_FACTOR);

    this.gifts.updateLivesText();
    this.gifts.updateCoinsText();

    this.startTime = this.time.now;
    this.timer = this.time.addEvent({
      delay: 1000,
      loop: true,
      callbackScope: this,
      callback: this.updateTracking,
    });

  };

  update() {
    if (!this.scene.isPaused()) {
      const controls = this.controls.getControls();
      this.player.update(controls);
      this.enemies.update();
      this.background.update(
        this.cameras.main.scrollX,
        this.cameras.main.scrollY
      );

      this.totalSessionTime = Math.floor(
        (this.time.now - this.startTime) / 1000
      );

      if (this.coinsCount === 3 && !this.isLevelComplete) {
        this.isLevelComplete = true;
        this.nextLevel();
      }
    }
  }

  nextLevel() {
    if (this.currentLevel >= MAX_LEVELS) {
      if (!this.isDataSaved) {
        this.saveData("No", this.currentLevel);
        this.isDataSaved = true;
      }
      window.location.href = "victory.html";
    } else {
      this.currentLevel += 1;
      this.scene.pause();
      setTimeout(() => {
        this.scene.restart();
      }, 3000);
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
        length: this.totalSessionTime,
        level: level,
        closed: hasClosed,
        score: this.score,
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

// Exporta la clase GameScene
export default GameScene;
