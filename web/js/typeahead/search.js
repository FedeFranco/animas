var publicaciones = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        url: urlPublicaciones,
        wildcard: '%QUERY'
    }
});

var publicacion = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        url: urlPublicaciones,
        wildcard: '%QUERY'
    }
});


$('.typeahead').typeahead({
    hint: true,
    minLength: 1,
}, {
    name: 'publicaciones',
    source: publicaciones,
    displayKey: 'titulo',
    limit: 5,
    templates: {
        header: '<h4 class="name" style="color: black; background-color: white;">Publicaciones</h4>',
        suggestion: function(data) {
            html = '<div class="media"  style=" background-color: white;>';
            html += '<p"><a href ="' + publicacionesView + data.id + '">' + data.titulo +'</a></p>';
            html += '</div></div>';
            return html;
        }
    }
}, {
    name: 'texto',
    source: publicacion,
    displayKey: 'cuerpo',
    limit: 5,
    templates: {
        header: '<h4 class="name" style="color: black; background-color: white;>Texto</h4>',
        suggestion: function(data) {
            html = '<div class="media row">';
            html += '<div class="media-body style=" background-color: blue; ">';
            html += '<p"><a href ="' + publicacionesView + data.id + '">' + data.cuerpo +'</a></p>';
            html += '</div></div>';
            return html;
        }
    }
}

);
$('#search-submit').on('click', function(event) {
    if ($('.tt-input').val() == "") {
        $('.input-group').off('hover');
        return false;
    };
});
