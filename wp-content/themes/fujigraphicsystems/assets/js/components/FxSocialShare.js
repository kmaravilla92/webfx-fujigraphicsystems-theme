window.addEventListener( 'load', () => {
    new FXSocialShare()
})



/**
 * Custom Social Share icons open windows
 * Generate URLs, place in a tag and use class - example: https://github.com/bradvin/social-share-urls
 * @type {Object}
 */
class FXSocialShare {

    constructor() {
        const self = this

        document.querySelectorAll('.js-social-share').forEach( el => {
            el.addEventListener( 'click', e => {
                e.preventDefault()

                self.windowPopup( this.href, 500, 300 )
            })
        })
    }

    windowPopup( url, width, height ) {
        const left  = ( screen.width / 2 ) - ( width / 2 ),
            top     = ( screen.height / 2 ) - ( height / 2 )

        window.open(
            url,
            '',
            `menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=${width},height=${height},top=${top},left=${left}`
        )
    }
}