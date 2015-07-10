// CSRF token
var _token = $('meta[name=_token]').attr('content');

$(document).ready(function() {
    // Error Creation

    function float_error(message, persistTime) {
        if(typeof message === 'undefined' || persistTime < 0)
        {
            return false;
        }

        var source = $("#float-error-template").html();
        var template = Handlebars.compile(source);
        var html = template({message: message});

        $(".float-error").fadeOut().remove(); // Removes any current float-errors.
        $("body").append(html);
        $(".float-error").fadeIn(1000);

        if(typeof persistTime === 'number' && persistTime > 0)
        {

        }
    }

    // School selection suggestions.

    var schoolSelect = $("#school-select");

    if(schoolSelect) {
        var schoolSelectId = $("#school-select-id");
        var schoolSelectSubmitTo = schoolSelect.data('submit-to');
        var schoolSuggestions = $(".school-suggestions");

        var schoolSuggestionTemplate = Handlebars.compile('<li class="school-suggestion list-group-item" data-school-id="{{id}}">{{ name }}</li>');

        // Sends query to server to lookup when done typing.
        schoolSelect.doneTyping(function(event) {
            var element = $(this);

            $.post(schoolSelectSubmitTo, { query: element.val(), _token: _token }, function(data) {
                if('schools' in data) {
                    schoolSuggestions.empty();

                    if(data.schools.length > 0) {
                        schoolSuggestions.slideDown();

                        $.each(data.schools, function(key, value) {
                            var templateContext = { id: value.id, name: value.name };
                            var newListItem = schoolSuggestionTemplate(templateContext);
                            schoolSuggestions.append(newListItem);
                        });
                    } else {
                        schoolSuggestions.slideUp(); // Hide if there are no results.
                        // TODO: Have a "no results" message appear.
                    }
                } else {
                    float_error("Unable to grab schools data.");
                }
            }, "json")
            .fail(function() {
                float_error("Unable to grab schools data.");
            });
        });

        // Listen for selecting the links.
        schoolSuggestions.on("click", ".school-suggestion", function() {
            var clickedElement = $(this);
            var school = {
                id: clickedElement.data('school-id'),
                name: clickedElement.text()
            };

            schoolSuggestions.hide();

            schoolSelect.val(school.name);
            schoolSelectId.val(school.id);
            schoolSelect.attr("readonly", true);
        });
    }

});

//# sourceMappingURL=main.js.map