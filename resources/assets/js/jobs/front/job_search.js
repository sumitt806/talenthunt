$(document).ready(function () {
    let salaryFromSlider = $('#salaryFrom');
    let salaryToSlider = $('#salaryTo');
    $(document).on('change', '.jobType', function () {
        let jobType = [];
        $('input:checkbox[name=job-type]:checked').each(function () {
            jobType.push($(this).val());
        });
        if (jobType.length > 0) {
            window.livewire.emit('changeFilter', 'types', jobType);
        } else {
            window.livewire.emit('resetFilter');
        }
    });

    salaryFromSlider.ionRangeSlider({
        type: 'single',
        min: 0,
        step: 100,
        max: 150000,
        max_postfix: '+',
        skin: 'round',
        onFinish: function (data) {
            window.livewire.emit('changeFilter', 'salaryFrom', data.from);
        },
    });

    salaryToSlider.ionRangeSlider({
        type: 'single',
        min: 0,
        step: 100,
        max: 150000,
        max_postfix: '+',
        skin: 'round',
        onFinish: function (data) {
            window.livewire.emit('changeFilter', 'salaryTo', data.from);
        },
    });

    $('#searchCategories').on('change', function () {
        window.livewire.emit('changeFilter', 'category', $(this).val());
    });

    $('#searchSkill').on('change', function () {
        window.livewire.emit('changeFilter', 'skill', $(this).val());
    });

    $('#searchGender').on('change', function () {
        window.livewire.emit('changeFilter', 'gender', $(this).val());
    });

    $('#searchCareerLevel').on('change', function () {
        window.livewire.emit('changeFilter', 'careerLevel', $(this).val());
    });
    
    $('#searchFunctionalArea').on('change', function () {
        window.livewire.emit('changeFilter', 'functionalArea', $(this).val());
    });

    if (input.location != '') {
        $('#searchByLocation').val(input.location);
        window.livewire.emit('changeFilter', 'searchByLocation',
            input.location);
    }

    if (input.keywords != '') {
        window.livewire.emit('changeFilter', 'title', input.keywords);
    }

    $(document).on('click', '.reset-filter', function () {
        window.livewire.emit('resetFilter');
        salaryFromSlider.data('ionRangeSlider').update({
            from: 0,
            to: 0,
        });
        salaryToSlider.data('ionRangeSlider').update({
            from: 0,
            to: 0,
        });
        $('#searchFunctionalArea').val('default').selectpicker('refresh');
        $('#searchCareerLevel').val('default').selectpicker('refresh');
        $('#searchGender').val('default').selectpicker('refresh');
        $('#searchSkill').val('default').selectpicker('refresh');
        $('#searchCategories').val('default').selectpicker('refresh');
        $('.jobType').each(function () {
            $(this).prop('checked', false);
        });
    });
});
