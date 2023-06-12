function deleteUser(userId, userName)
    {
        if (confirm(`Are You Sure to Delete ${userName}'s Record?`))
        {
            window.location.href = 'http://food-order.test/crud-oops/delete-users.php?type=delete&id=' + userId;
        }
    }