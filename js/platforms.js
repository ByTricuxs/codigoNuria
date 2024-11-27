export default class Platforms {
    constructor(scene) {
        this.scene = scene;
        this.group = this.scene.physics.add.staticGroup();
      }
    
      preload() {
        this.scene.load.image("plataformLeft", "./img/sources/plataforms/left.png");
        this.scene.load.image("plataformRight", "./img/sources/plataforms/right.png");
        this.scene.load.image("plataformMidle", "./img/sources/plataforms/midle.png");
      }
    
      create(platformData) {
        platformData.forEach(platform => {
          const platformSprite = this.group.create(platform.x, platform.y, platform.type);
          platformSprite.setScale(0.7).refreshBody();
        });
      }
    }