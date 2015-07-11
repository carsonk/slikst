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

    // Handles grabbing suggestions from the server.
    function SuggestionsManager()
    {
        var suggestionsInputs = $(".suggestion-input");
        var suggestionItemTemplate = Handlebars.compile('<li class="suggestion-item list-group-item" data-item-id="{{id}}">{{ name }}</li>');

        this.init = function() {
            this.watchInputFields();
            this.watchSuggestionClicks();
        };

        this.watchInputFields = function() {
            suggestionsInputs.doneTyping(function(event) {
                var inputElement = $(this);
                var submitToUrl = inputElement.data('suggestion-submit-to');
                var suggestionsContainer = inputElement.closest('.suggestion-container');
                var suggestionsList = suggestionsContainer.find('.suggestion-list');
                var returnFieldName = inputElement.data('return-field');

                console.debug('Fetching suggestions from ' + submitToUrl + ' for field name ' + returnFieldName + ' with query "' + inputElement.val() + '"');

                $.post(submitToUrl, { query: inputElement.val(), _token: _token }, function(data) {
                    console.debug('Processing returned data.');

                    if(returnFieldName in data) {
                        suggestionsList.empty();

                        if(data[returnFieldName].length > 0) {
                            suggestionsList.slideDown();

                            $.each(data[returnFieldName], function(key, value) {
                                var templateContext = { id: value.id, name: value.name };
                                var newListItem = suggestionItemTemplate(templateContext);
                                suggestionsList.append(newListItem);
                            });
                        } else {
                            suggestionsList.slideUp(); // Hide if there are no results.
                            // TODO: Have a "no results" message appear.
                            console.debug('No suggestions provided for ' + returnFieldName);
                        }
                    } else {
                        console.debug('Unable to grab suggestions data.');
                        float_error("Unable to grab suggestions data.");
                    }
                }, "json")
                .fail(function() {
                    float_error("Unable to grab suggestions data.");
                });
            });
        };

        this.watchSuggestionClicks = function() {
            $(".suggestion-list").on("click", ".suggestion-item", function() {
                var clickedElement = $(this);
                var item = {
                    id: clickedElement.data('item-id'),
                    name: clickedElement.text()
                };

                var suggestionsList = clickedElement.parent();
                suggestionsList.hide();

                var suggestionsContainer = clickedElement.closest('.suggestion-container');

                var suggestionsInput = suggestionsContainer.find('.suggestion-input');
                var suggestionsId = suggestionsContainer.find('.suggestion-id');

                suggestionsInput.val(item.name);
                suggestionsId.val(item.id);
                suggestionsInput.attr("readonly", true);
            });
        };
    }

    var suggestionsManager = new SuggestionsManager();
    suggestionsManager.init();

});

//# sourceMappingURL=main.js.map