
var acelaya = {
    init: function () {
        this.initFileUpload();
    },

    /**
     * Initializes asynchronous file uploads
     */
    initFileUpload: function () {
        var $form = $('#uploadFiles');
        if ($form.size() === 0) {
            return;
        }

        $form.submit(function (e) {
            e.preventDefault();
            acelaya.uploadFiles($(this));
        });
    },

    uploadFiles: function ($form) {
        var action = $form.attr('action'),
            method = $form.attr('method');

        $.ajax({
            url: action,
            type: method,
            data: new FormData($form[0]),
            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {
                // This will make the ajax request to use a custom XHR object which will handle the progress
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                    var progressBar = acelaya.createProgressBar($form);

                    // Add progress event handler
                    myXhr.upload.addEventListener('progress', function(e) {
                        acelaya.handleUploadProgress(e, progressBar);
                    }, false);
                    myXhr.upload.addEventListener('load', function() {
                        // Firefox does not trigger the 'progress' event when upload is 100%.
                        // This forces progress to end when upload is successful
                        progressBar.find('.progress-bar').css({width : '100%'});
                    }, false);
                }

                return myXhr;
            }
        }).done(function (resp) {

        });
    },

    /**
     * Performs operations to display the progress of file uploads
     * @param {Object} e
     * @param {jQuery} progressBar
     */
    handleUploadProgress: function (e, progressBar) {
        if (! e.lengthComputable) {
            return;
        }

        var percent = e.total > 0 ? e.loaded * 100 / e.total : 100;
        progressBar.find('.progress-bar').css({width : percent + '%'});
        progressBar.find('.progress-bar').text(parseInt(percent) + '%');
    },

    /**
     * Creates a bootstrap progress bar for provided form an returns it as a jQuery object
     * @param {jQuery} $form
     * @returns {jQuery}
     */
    createProgressBar: function ($form) {
        var $fieldset = $form.closest('fieldset'),
            progressBar =
            '<div class="progress">' +
                '<div class="progress-bar progress-bar-striped active" role="progressbar">0%</div>' +
            '</div>';

        $fieldset.find('.progress').remove();
        $fieldset.append(progressBar);

        return $fieldset.find('.progress');
    }
};

$(document).ready(function () {
    acelaya.init();
});