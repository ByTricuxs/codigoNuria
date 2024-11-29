// Gifts.js
export default class Gifts {
  constructor(scene) {
    this.scene = scene;
    this.giftsGroup = this.scene.physics.add.staticGroup();
  }

  preload() {
    this.scene.load.spritesheet(
      "coin",
      "./img/sources/power_ups/coin.png",
      { frameWidth: 700, frameHeight: 700 }
    );
    this.scene.load.spritesheet(
      "bottle",
      "./img/sources/power_ups/bottle.png",
      { frameWidth: 700, frameHeight: 700 }
    );
  }

  create(giftsData) {
    giftsData.forEach((gift) => {
      const newGift = this.giftsGroup
        .create(gift.x, gift.y, gift.key)
        .setScale(0.1)
        .refreshBody();
      this.createAnimations(gift.key);
      newGift.anims.play(gift.key);
    });
  }

  createAnimations(key) {
    if (!this.scene.anims.exists(key)) { 
      this.scene.anims.create({
        key,
        frames: this.scene.anims.generateFrameNumbers(key, { start: 0, end: 7 }),
        frameRate: 8,
        repeat: -1,
      });
    }
  }

  collectGifts(player, gift) {
    switch (gift.texture.key) {
      case "coin":
        this.collectCoin(player, gift);
        break;
      case "bottle":
        this.collectBottle(player, gift);
        break;
    }
    gift.destroy();
  }

  // Collect a coin
  collectCoin(player, coin) {
    this.scene.coinsCount += 1;
    this.scene.score += 15;
    this.updateCoinsText();

    if (this.scene.coinsCount === 3) {
      this.showVictoryMessage();
    }
  }

  // Collect a health bottle
  collectBottle(player, bottle) {
    this.scene.lives += 1;
    this.updateLivesText();
  }

  updateLivesText(scene) {
    const livesTextElement = document.getElementById("livesText");
    if (livesTextElement) {
      livesTextElement.textContent = `Lives: ${this.scene.lives}`;
    }
  }

  updateCoinsText(scene) {
    const coinsTextElement = document.getElementById("coinsText");
    if (coinsTextElement) {
      coinsTextElement.textContent = `Coins: ${this.scene.coinsCount}`;
    }
  }
  
  showVictoryMessage(player) {
    const victoryMessage = document.getElementById("victoryMessage");
    victoryMessage.classList.remove("hidden");
    victoryMessage.classList.add("visible");

    setTimeout(() => {
      victoryMessage.classList.remove("visible");
      victoryMessage.classList.add("hidden");
    }, 3000);
  }
}
