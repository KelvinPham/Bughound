const CLIENT_HASH_ITERATIONS = 1024 // This is dreadfully low, we're not going to use salts, And we shouldn't be doing this at all. -JC

function process_login_form(form) 
{
    if (form.username.value === '') 
    {
        alert('Failed login: Username must be filled in.')
        return false
    }

    if (form.password.value === '') 
    {
        alert('Failed login: Password must be filled in.')
        return false
    }
    else
    {
        for(let i = 0; i < CLIENT_HASH_ITERATIONS; ++i)  { form.password.value = sha512(form.password.value) }
        form.password.value = form.password.value.substr(0,32)
    }
    
    return true
}