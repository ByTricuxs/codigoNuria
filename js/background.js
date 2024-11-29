export default class Background {
  constructor(scene) {
    this.scene = scene;
    this.layers = [];
  }

  preload() {
    this.scene.load.image("background1", "./img/sources/background/background_1.png");
    this.scene.load.image("background2", "./img/sources/background/background_2.png");
    this.scene.load.image("background3", "./img/sources/background/background_3.png");
    this.scene.load.image("layer3", "./img/sources/background/layer_3.png");
    this.scene.load.image("layer2", "./img/sources/background/layer_2.png");
    this.scene.load.image("layer1", "./img/sources/background/layer_1.png");
    this.scene.load.image("layer0", "./img/sources/background/layer_0.png");
  }

  create(backgroundLayers) {
    const createLayer = (x, y, key, scrollFactor) =>
      this.scene.add.image(x, y, key).setOrigin(0, 0).setScrollFactor(scrollFactor);
  
    backgroundLayers.forEach((layer, index) => {
      let scrollFactor = 1;
  
      switch (index) {
        case 0: 
          scrollFactor = 0.2; 
          break;
        case 1: 
          scrollFactor = 0.6; 
          break;
        case 2: 
          scrollFactor = 0.1; 
          break;
        case 3: 
          scrollFactor = 0.3; 
          break;
        default:
          scrollFactor = 1;
          break;
      }
  
      this.layers.push(createLayer(layer.x, layer.y, layer.key, scrollFactor));
    });
  
    this.scene.layer2 = this.scene.physics.add
      .staticImage(1, 900, "layer2")
      .setOrigin(0, 0)
      .setScale(1)
      .refreshBody(); 

    createLayer(0, 0, "layer1", 1);
    createLayer(0, 0, "layer0", 1);
}

  update(scrollX, scrollY) {
    if (this.layers[4]) this.layers[4].x = -scrollX * 0.1;
    if (this.layers[4]) this.layers[4].y = -scrollY * 0.1;
    if (this.layers[3]) this.layers[3].x = -scrollX * 0.3;
    if (this.layers[3]) this.layers[3].y = -scrollY * 0.3;
  }
}