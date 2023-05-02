import './bootstrap';

$('#checkIssueForm').on('submit', function(e) {
    e.preventDefault();
    axios.post('/api/check-issue', {
        term: $('input[name=term]').val(),
        platform_id: $('select[name=platform_id]').val()
    })
    .then(function(response) {
        $('#checkIssueModal').modal('hide');
        $('#term').html(response.data.term);
        $('#score').html(response.data.score);
        $('#resultModal').modal('show');
    })
    .catch(function(error) {
        $('#checkIssueModal').modal('hide');
        if (error.response.status === 422) {
            showErrors(error, 'danger');
        }
        else {
            showMessage('No data!', 'danger');
        }
    })
    .finally(function() {
        $('#inputName').val('');
    });
});

$('#newPlatformForm').on('submit', function(e) {
    e.preventDefault();
    axios.post('/platform', {
        title: $('input[name=title]').val(),
        route: $('input[name=route]').val(),
        positive: $('input[name=positive]').val(),
        negative: $('input[name=negative]').val(),
    })
    .then(function(response) {
        $('#newPlatformModal').modal('hide');
        showMessage('New Platform successfuly created!', 'success');
    })
    .catch(function(error) {
        $('#newPlatformModal').modal('hide');
        if (error.response.status === 422) {
            showErrors(error, 'danger');
        }
    })
    .finally(clearFields());
});

$('.editPlatform').on('click', function(e){
    e.preventDefault();
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
    axios.put('/platform/'+$('input[name=id]').val(), {
        title: $('input[name=title1]').val(),
        route: $('input[name=route1]').val(),
        positive: $('input[name=positive1]').val(),
        negative: $('input[name=negative1]').val(),
    })
    .then(function(response) {
        $('#editPlatformModal').modal('hide');
        showMessage('Platform successfuly updated!', 'success');
    })
    .catch(function(error) {
        $('#editPlatformModal').modal('hide');
        if (error.response.status === 422) {
            showErrors(error, 'danger');
        }
    })
    .finally(clearFields());
});

$('.deletePlatform').on('click', function(e) {
    e.preventDefault();
    if(confirm('Are you sure?') == false) return;  
    axios.delete('/platform/'+$(this).data('platform'))
        .then(function (response) {
            showMessage('Platform successfuly deleted!', 'success')
        });
});

$('.close').on('click', function(e){
    e.preventDefault();
    clearFields();        
});

$('.reload').on('click', function(e){
    e.preventDefault();    
    clearFields();  
    location.reload();
});

function showMessage(message, color) {
    $('#message').html(message);
    $('#showMessageModal .modal-header').addClass(color);
    $('#showMessageModal').modal('show');
    clearFields();
}

function showErrors(error, color) {
    const validationErrors = error.response.data.errors;
    var errors = '<ul>';
    Object.keys(validationErrors).forEach(key => {
        errors += '<li>' + validationErrors[key] + '</li>';
    });
    errors += '</ul>';

    showMessage(errors, color)
}

function clearFields() {
    $('#inputTitle').val('');
    $('#inputRoute').val('');
    $('#inputPositive').val('');
    $('#inputNegative').val('');
}
