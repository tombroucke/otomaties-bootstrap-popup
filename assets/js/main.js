import Cookie from './cookie';

jQuery(document).ready(function($){
	let cookie;
	if( $('#otomatiesModal').length ) {
		const show_once = $('#otomatiesModal').data('showonce');
		const delay = $('#otomatiesModal').data('delay');
		if( show_once ) {
			cookie = new Cookie("saw_" + show_once)

			if( cookie.get() != "" ) {
				return false;
			}

			cookie.set(this.show_once)
		}
		window.setTimeout(function(){
			$('#otomatiesModal').modal('show')
		}, delay);
	}
});
