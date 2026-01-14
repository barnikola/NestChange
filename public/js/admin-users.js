document.querySelector('.search-input').addEventListener('keyup', async (e) => {
    const query = e.target.value;
    const tbody = document.querySelector('tbody');

    const res = await fetch('/admin/users?search=' + encodeURIComponent(query), {
        headers: { 'Accept': 'application/json' }
    });

    const users = await res.json();
    tbody.innerHTML = '';

    if (users.length === 0) {
        tbody.innerHTML = '<tr><td colspan="6" style="text-align:center; padding:30px;">No users found.</td></tr>';
        return;
    }

    users.forEach(user => {
        const name = (user.first_name || '') + ' ' + (user.last_name || '');

        tbody.innerHTML += `
            <tr>
                <td><span class="mobile-label">ID:</span> ${user.id}</td>
                <td><span class="mobile-label">Name:</span> ${name}</td>
                <td><span class="mobile-label">Email:</span> ${user.email}</td>
                <td><span class="mobile-label">Role:</span> ${user.role}</td>
                <td>
                    <span class="mobile-label">Status:</span>
                    <span class="status ${user.status}">${user.status}</span>
                </td>
                <td class="actions">
                    <span class="mobile-label">Actions:</span>
                    ${user.status !== 'approved' ? `
                    <form action="/admin/users/approve" method="POST" style="display:inline; margin-right:5px;" onsubmit="return confirm('Approve?');">
                        <input type="hidden" name="user_id" value="${user.id}">
                        <button type="submit" style="background:#4CAF50; color:white;">Approve</button>
                    </form>` : ''}
                    
                    ${user.status !== 'suspended' ? `
                    <form action="/admin/users/suspend" method="POST" style="display:inline; margin-right:5px;" onsubmit="return confirm('Suspend?');">
                        <input type="hidden" name="user_id" value="${user.id}">
                        <button type="submit" style="background:#FF9800; color:white;">Suspend</button>
                    </form>` : ''}

                    <form action="/admin/users/delete" method="POST" style="display:inline;" onsubmit="return confirm('Delete?');">
                        <input type="hidden" name="user_id" value="${user.id}">
                        <button type="submit" class="delete">Delete</button>
                    </form>
                </td>
            </tr>`;
    });
});
