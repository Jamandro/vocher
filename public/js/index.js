$(function() {
    // dynamic table
    $('#dyntable').dynatable({
        features: {
            paginate: true,
            search: true,
            recordCount: true
        },
    });
});