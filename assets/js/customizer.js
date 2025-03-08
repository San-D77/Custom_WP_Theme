jQuery(document).ready(function ($) {
    wp.customize('number_of_categories', function (setting) {
        setting.bind(function (newValue) {
            var dropdownContainer = $('#customize-control-selected_categories_control');
            dropdownContainer.empty(); // Clear previous dropdowns
            dropdownContainer.append('<label class="customize-control-title">Selected Categories</label><div class="dynamic-categories-dropdowns"></div>');

            var dropdownsContainer = dropdownContainer.find('.dynamic-categories-dropdowns');

            // Fetch categories via AJAX
            $.ajax({
                url: mythemeCustomizerData.ajax_url,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'mytheme_get_categories',
                    nonce: mythemeCustomizerData.nonce
                },
                success: function (response) {
                    if (response.success) {
                        for (var i = 0; i < newValue; i++) {
                            var selectHTML = '<select class="dynamic-category-select"><option value="">Select a Category</option>';
                            $.each(response.data, function (index, category) {
                                selectHTML += '<option value="' + category.id + '">' + category.name + '</option>';
                            });
                            selectHTML += '</select>';
                            dropdownsContainer.append(selectHTML);
                        }
                    }
                }
            });

            // dropdownsContainer.on('change', 'select.dynamic-category-select', function () {
            //     var selectedCategories = dropdownsContainer.find('select').map(function () {
            //         return $(this).val(); // Assuming the value of each select is the category ID
            //     }).get().filter(function (id) { return id; }); // Filter out any empty values

            //     wp.customize.control('selected_categories_control').setting.set(JSON.stringify(selectedCategories));
            // });
        });
    });

    // wp.customize.bind('ready', function () {
    //     var savedCategoriesJson = wp.customize.control('selected_categories_control').setting.get();
    //     if (savedCategoriesJson) {
    //         var savedCategories = JSON.parse(savedCategoriesJson);
    //         // Assuming this triggers the AJAX call again to recreate dropdowns and then populate them
    //         wp.customize.control('number_of_categories').setting.set(savedCategories.length);
    //     }
    // });
});
