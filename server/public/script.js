$( document ).ready(function() {
    let scriptUrl = 'script.php';
    let tableBody = $('tbody');

    getData();

    $('form').submit(function(e) {
        e.preventDefault();
        form = $(this);
        getData('POST', form.serialize());
    });

    function getData(method = '', data = []) {
        let options = {
            url: scriptUrl
        }

        if(method.length){
            options.type = method;
        }

        if(data.length){
            options.data = data;
        }

        $.ajax(options).done(function(response) {
            let data = JSON.parse(response);
            tableBody.find('tr').remove();
            $.each(data, function(i) {
                tableBody.append(
                    '<tr>' +
                    '<th scope="row">'+ (i+1) + '</th>' +
                    '<td>' + this.name + '</td>' +
                    '<td>' + this.price + '</td>' +
                    '<td>' + this.qty + '</td>' +
                    '</tr>');
            });
        }).fail(function() {
            console.log('fail');
        });
    }
});
