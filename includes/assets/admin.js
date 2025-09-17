jQuery(document).ready(function($) {
    'use strict';

    // Main admin object
    window.DevPropertyAdmin = {
        
        // Initialize all functionality
        init: function() {
            this.initSectionToggles();
            this.initMediaUploads();
            this.initGalleryUploads();
            this.initFieldValidation();
            this.initAutoSave();
        },

        // Toggle section visibility
        initSectionToggles: function() {
            $('.dev-section-title').on('click', function() {
                var $section = $(this).closest('.dev-property-section');
                var $content = $section.find('.dev-section-content');
                
                if ($content.is(':visible')) {
                    $content.slideUp(300);
                    $(this).addClass('collapsed');
                } else {
                    $content.slideDown(300);
                    $(this).removeClass('collapsed');
                }
            });

            // Remember collapsed state
            $('.dev-section-title').each(function() {
                var sectionId = $(this).closest('.dev-property-section').data('section');
                var isCollapsed = localStorage.getItem('dev_section_' + sectionId + '_collapsed');
                
                if (isCollapsed === 'true') {
                    $(this).addClass('collapsed');
                    $(this).closest('.dev-property-section').find('.dev-section-content').hide();
                }
            });

            // Save collapsed state
            $('.dev-section-title').on('click', function() {
                var sectionId = $(this).closest('.dev-property-section').data('section');
                var isCollapsed = $(this).hasClass('collapsed');
                localStorage.setItem('dev_section_' + sectionId + '_collapsed', isCollapsed);
            });
        },

        // Initialize media upload functionality
        initMediaUploads: function() {
            var mediaUploader;

            $('.dev-media-upload').on('click', function(e) {
                e.preventDefault();
                
                var $button = $(this);
                var targetId = $button.data('target');
                var $preview = $('#' + targetId + '_preview');
                var $input = $('#' + targetId);

                // If the uploader object has already been created, reopen the dialog
                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }

                // Create the media frame
                mediaUploader = wp.media({
                    title: devPropertyAdmin.strings.selectMedia,
                    button: {
                        text: devPropertyAdmin.strings.selectMedia
                    },
                    multiple: false
                });

                // When a file is selected, run a callback
                mediaUploader.on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    
                    $input.val(attachment.id);
                    $preview.html('<img src="' + attachment.sizes.thumbnail.url + '" alt="' + attachment.alt + '" />');
                    $button.siblings('.dev-media-remove').show();
                });

                // Open the uploader dialog
                mediaUploader.open();
            });

            // Remove media
            $('.dev-media-remove').on('click', function(e) {
                e.preventDefault();
                
                var $button = $(this);
                var targetId = $button.data('target');
                var $preview = $('#' + targetId + '_preview');
                var $input = $('#' + targetId);

                $input.val('');
                $preview.empty();
                $button.hide();
            });
        },

        // Initialize gallery upload functionality
        initGalleryUploads: function() {
            var galleryUploader;

            $('.dev-gallery-upload').on('click', function(e) {
                e.preventDefault();
                
                var $button = $(this);
                var targetId = $button.data('target');
                var $preview = $('#' + targetId + '_preview');
                var $input = $('#' + targetId);

                // Create the media frame
                galleryUploader = wp.media({
                    title: devPropertyAdmin.strings.selectGallery,
                    button: {
                        text: devPropertyAdmin.strings.selectGallery
                    },
                    multiple: true
                });

                // When files are selected, run a callback
                galleryUploader.on('select', function() {
                    var attachments = galleryUploader.state().get('selection').toJSON();
                    var attachmentIds = [];
                    var previewHtml = '';

                    $.each(attachments, function(index, attachment) {
                        attachmentIds.push(attachment.id);
                        previewHtml += '<div class="gallery-item">';
                        previewHtml += '<img src="' + attachment.sizes.thumbnail.url + '" alt="' + attachment.alt + '" />';
                        previewHtml += '<button type="button" class="remove-item" data-id="' + attachment.id + '">×</button>';
                        previewHtml += '</div>';
                    });

                    $input.val(attachmentIds.join(','));
                    $preview.html(previewHtml);
                });

                // Open the uploader dialog
                galleryUploader.open();
            });

            // Remove gallery item
            $(document).on('click', '.remove-item', function(e) {
                e.preventDefault();
                
                var $button = $(this);
                var attachmentId = $button.data('id');
                var $galleryField = $button.closest('.dev-gallery-field');
                var $input = $galleryField.find('input[type="hidden"]');
                var $preview = $galleryField.find('.dev-gallery-preview');
                
                var currentIds = $input.val().split(',');
                var newIds = currentIds.filter(function(id) {
                    return id !== attachmentId.toString();
                });
                
                $input.val(newIds.join(','));
                $button.closest('.gallery-item').remove();
            });
        },

        // Initialize field validation
        initFieldValidation: function() {
            // Email validation
            $('input[type="email"]').on('blur', function() {
                var $field = $(this);
                var email = $field.val();
                
                if (email && !DevPropertyAdmin.isValidEmail(email)) {
                    $field.addClass('field-error');
                    DevPropertyAdmin.showFieldMessage($field, 'Please enter a valid email address.', 'error');
                } else {
                    $field.removeClass('field-error').addClass('field-success');
                    DevPropertyAdmin.hideFieldMessage($field);
                }
            });

            // URL validation
            $('input[type="url"]').on('blur', function() {
                var $field = $(this);
                var url = $field.val();
                
                if (url && !DevPropertyAdmin.isValidUrl(url)) {
                    $field.addClass('field-error');
                    DevPropertyAdmin.showFieldMessage($field, 'Please enter a valid URL.', 'error');
                } else {
                    $field.removeClass('field-error').addClass('field-success');
                    DevPropertyAdmin.hideFieldMessage($field);
                }
            });

            // Number validation
            $('input[type="number"]').on('blur', function() {
                var $field = $(this);
                var value = parseFloat($field.val());
                var min = parseFloat($field.attr('min'));
                var max = parseFloat($field.attr('max'));
                
                if ($field.val() && (isNaN(value) || (min && value < min) || (max && value > max))) {
                    $field.addClass('field-error');
                    DevPropertyAdmin.showFieldMessage($field, 'Please enter a valid number.', 'error');
                } else {
                    $field.removeClass('field-error').addClass('field-success');
                    DevPropertyAdmin.hideFieldMessage($field);
                }
            });
        },

        // Initialize auto-save functionality
        initAutoSave: function() {
            var autoSaveTimeout;
            
            $('.dev-property-table input, .dev-property-table select, .dev-property-table textarea').on('change', function() {
                clearTimeout(autoSaveTimeout);
                autoSaveTimeout = setTimeout(function() {
                    DevPropertyAdmin.autoSave();
                }, 2000);
            });
        },

        // Auto-save function
        autoSave: function() {
            var $form = $('#post');
            var formData = $form.serialize();
            
            $.ajax({
                url: devPropertyAdmin.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'dev_property_auto_save',
                    nonce: devPropertyAdmin.nonce,
                    form_data: formData,
                    post_id: $('#post_ID').val()
                },
                success: function(response) {
                    if (response.success) {
                        DevPropertyAdmin.showMessage('Auto-saved successfully!', 'success');
                    }
                },
                error: function() {
                    DevPropertyAdmin.showMessage('Auto-save failed.', 'error');
                }
            });
        },

        // Utility functions
        isValidEmail: function(email) {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        },

        isValidUrl: function(url) {
            try {
                new URL(url);
                return true;
            } catch (e) {
                return false;
            }
        },

        showFieldMessage: function($field, message, type) {
            var $message = $field.siblings('.field-message');
            if ($message.length === 0) {
                $message = $('<div class="field-message dev-message ' + type + '"></div>');
                $field.after($message);
            }
            $message.text(message).show();
        },

        hideFieldMessage: function($field) {
            $field.siblings('.field-message').hide();
        },

        showMessage: function(message, type) {
            var $message = $('<div class="dev-message ' + type + '">' + message + '</div>');
            $('.dev-property-meta-container').prepend($message);
            
            setTimeout(function() {
                $message.fadeOut(function() {
                    $message.remove();
                });
            }, 3000);
        }
    };

    // Initialize property admin functionality AFTER defining the object
    DevPropertyAdmin.init();

    // Load existing media previews on page load
    $('.dev-media-field input[type="hidden"]').each(function() {
        var $input = $(this);
        var attachmentId = $input.val();
        var $preview = $('#' + $input.attr('id') + '_preview');
        
        if (attachmentId) {
            $.ajax({
                url: devPropertyAdmin.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'dev_get_attachment_data',
                    nonce: devPropertyAdmin.nonce,
                    attachment_id: attachmentId
                },
                success: function(response) {
                    if (response.success) {
                        $preview.html('<img src="' + response.data.thumbnail + '" alt="' + response.data.alt + '" />');
                        $input.siblings('.dev-media-remove').show();
                    }
                }
            });
        }
    });

    // Load existing gallery previews on page load
    $('.dev-gallery-field input[type="hidden"]').each(function() {
        var $input = $(this);
        var attachmentIds = $input.val();
        var $preview = $('#' + $input.attr('id') + '_preview');
        
        if (attachmentIds) {
            var ids = attachmentIds.split(',');
            $.each(ids, function(index, id) {
                if (id.trim()) {
                    $.ajax({
                        url: devPropertyAdmin.ajaxUrl,
                        type: 'POST',
                        data: {
                            action: 'dev_get_attachment_data',
                            nonce: devPropertyAdmin.nonce,
                            attachment_id: id.trim()
                        },
                        success: function(response) {
                            if (response.success) {
                                var previewHtml = '<div class="gallery-item">';
                                previewHtml += '<img src="' + response.data.thumbnail + '" alt="' + response.data.alt + '" />';
                                previewHtml += '<button type="button" class="remove-item" data-id="' + id.trim() + '">×</button>';
                                previewHtml += '</div>';
                                $preview.append(previewHtml);
                            }
                        }
                    });
                }
            });
        }
    });
});
