import {Component} from './component'
import Cookie from './cookie'

class Popup extends Component {

  constructor(el, settings = {}) {

    const default_settings = {
      attributes: {
        showonce: false
      }
    }

    super(el, default_settings, settings)
    this.el = el;
    this.close = this.el.querySelector('.close')

    if(this.shouldShow()) {
      this.openPopup();
    }

    this.addEvents();

  }

  shouldShow() {
    if(this.settings.showonce) {
      this.cookie = new Cookie("saw_" + this.settings.showonce)

      if( this.cookie.get() != "" ) {
        return false;
      }

      this.cookie.set(this.settings.showonce)
    }
    return true;
  }

  addEvents() {
    console.log('addevents')
    if(this.close) {
      this.close.addEventListener('click', this.closePopup.bind(this))
    }
  }

  openPopup() {
    this.el.classList.add('open')
  }

  closePopup() {
    console.log('close')
    this.el.classList.remove('open')
  }
}

export default Popup
