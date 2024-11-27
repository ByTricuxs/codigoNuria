export default class OrientationManager {
    constructor(scene) {
      this.scene = scene;
      this.orientationMessage = null;
      this.isPaused = false;
    }
  
    create() {
      this.scene.events.once('create', () => {
        this.orientationMessage = document.getElementById('message');
        this.checkOrientation(); 
        screen.orientation.addEventListener('change', this.checkOrientation.bind(this));
      });
    }
  
    checkOrientation() {
      const orientation = screen.orientation || screen.mozOrientation || screen.msOrientation;
      if (orientation.type.includes('portrait')) {
        if (this.orientationMessage) {
          this.orientationMessage.classList.remove('hidden');
        }
        if (!this.isPaused) {
          this.scene.scene.pause();
          this.isPaused = true;
        }
      } else if (orientation.type.includes('landscape')) {
        if (this.orientationMessage) {
          this.orientationMessage.classList.add('hidden'); 
        }
        if (this.isPaused) {
          this.scene.scene.resume(); 
          this.isPaused = false;
        }
      }
    }
  }
  