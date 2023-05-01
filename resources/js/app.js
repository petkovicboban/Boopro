import './bootstrap';

$('#checkIssueForm').on('submit', function(e) {
    e.preventDefault();
    $('#results').hide();
    $('#no-data').hide();
    axios.post('/api/check-issue', {
        term: $('input[name=term]').val(),
        platform_id: $('select[name=platform_id]').val()
    })
    .then(function(response) {
        $('#checkIssueModal').modal('hide');
        $('#term').html(response.data.term);
        $('#score').html(response.data.score);
        $('#results').show();

        return new Promise((resolve) => {
            setTimeout(function() {
                resolve();
            }, 1500 )
        })
        .then(() => {
            location.reload();
        });
    })
    .catch(function(error) {
        $('#checkIssueModal').modal('hide');
        $('#no-data').show();
        if (error.response.status === 422) {
            const validationErrors = error.response.data.errors;
            var errors = '<ul>';
            Object.keys(validationErrors).forEach(key => {
                errors += '<li>' + validationErrors[key] + '</li>';
            });
            errors += '</ul>';
            $('#message').html(errors);
        }
        else {
            $('#message').html(['No data!']);
        }
    })
    .finally(function() {
        $('#inputName').val('');
    });
});

$('#newPlatformForm').on('submit', function(e) {
    e.preventDefault();
    $('#results').hide();
    $('#no-data').hide();
    axios.post('/platform', {
        title: $('input[name=title]').val(),
        route: $('input[name=route]').val(),
        positive: $('input[name=positive]').val(),
        negative: $('input[name=negative]').val(),
    })
    .then(function(response) {
        $('#newPlatformModal').modal('hide');
        showMessage('New Platform successfuly created!');
    })
    .catch(function(error) {
        $('#newPlatformModal').modal('hide');
        $('#no-data').show();

        if (error.response.status === 422) {
            showErrors(error);
        }
    })
    .finally(clearFields());
});

$('.editPlatform').on('click', function(){
    axios.get('/platform/'+$(this).data('platform')+'/edit')
    .then(function(response) {
        $('input[name=id]').val(response.data.platform.id);
        $('input[name=title1]').val(response.data.platform.title);
        $('input[name=route1]').val(response.data.platform.route);
        $('input[name=positive1]').val(response.data.platform.positive);
        $('input[name=negative1]').val(response.data.platform.negative);
    })
    .catch(function(error) {
        console.log('Something\'s wrong...');
    });
});

$('#editPlatformForm').on('submit', function(e) {
    e.preventDefault();
    $('#results').hide();
    $('#no-data').hide();
    axios.put('/platform/'+$('input[name=id]').val(), {
        title: $('input[name=title1]').val(),
        route: $('input[name=route1]').val(),
        positive: $('input[name=positive1]').val(),
        negative: $('input[name=negative1]').val(),
    })
    .then(function(response) {
        $('#editPlatformModal').modal('hide');
        showMessage('Platform successfuly updated!');
    })
    .catch(function(error) {
        $('#editPlatformModal').modal('hide');
        $('#no-data').show();

        if (error.response.status === 422) {
            showErrors(error);
        }
    })
    .finally(clearFields());
});

$('.deletePlatform').on('click', function() {
    if(confirm('Are you sure?') == false) return;  
    axios.delete('/platform/'+$(this).data('platform'))
        .then(function (response) {
              location.reload();               
        });
});

$('.close').on('click', function(e){
    e.preventDefault();
    clearFields();        
});

function showMessage(message)
{
    $('#results').show();
    $('#results').html(message);
    clearFields();

    return new Promise((resolve) => {
        setTimeout(function() {
            resolve();
        }, 1500 )
    })
    .then(() => {
        location.reload();
    });
}

function showErrors(error) {
    const validationErrors = error.response.data.errors;
    var errors = '<ul>';
    Object.keys(validationErrors).forEach(key => {
        errors += '<li>' + validationErrors[key] + '</li>';
    });
    errors += '</ul>';
    $('#message').html(errors);
    return;
}

function clearFields() {
    $('#inputTitle').val('');
    $('#inputRoute').val('');
    $('#inputPositive').val('');
    $('#inputNegative').val('');
}
