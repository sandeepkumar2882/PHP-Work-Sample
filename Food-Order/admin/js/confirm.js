
function deleteUser(userId)
    {
        if (confirm('Are You Sure to Delete this Record?'))
        {
            window.location.href = 'http://food-order.test/admin/delete-admin.php?id=' + userId;
        }
    }