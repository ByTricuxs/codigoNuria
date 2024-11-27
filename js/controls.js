export default class Controls {
  constructor(scene) {
    this.scene = scene;
    this.isMobile = /Mobi|Android/i.test(navigator.userAgent);
    this.cursors = null;
    this.joystickCursors = null;
  }

  preload() {
    if (this.isMobile) {
      this.scene.load.plugin(
        "rexvirtualjoystickplugin",
        "https://raw.githubusercontent.com/rexrainbow/phaser3-rex-notes/master/dist/rexvirtualjoystickplugin.min.js",
        true
      );
    }
  }

  create() {
    if (this.isMobile) {
      this.joystickCursors = this.scene.plugins
        .get("rexvirtualjoystickplugin")
        .add(this.scene, {
          x: 100,
          y: 300,
          radius: 50,
          base: this.scene.add.circle(100, 300, 50, 0x888888).setDepth(11),
          thumb: this.scene.add.circle(100, 300, 25, 0xcccccc).setDepth(12),
        });
      this.joystickCursors = this.joystickCursors.createCursorKeys();
    } else {
      this.cursors = this.scene.input.keyboard.createCursorKeys();
    }
  }

  getControls() {
    if (this.isMobile) {
      return this.joystickCursors;
    } else {
      return this.cursors;
    }
  }
}
