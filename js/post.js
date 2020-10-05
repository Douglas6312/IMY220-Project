$(document).ready(() =>{

    const userDetails = JSON.parse(localStorage.getItem('userDetails'));
    if (userDetails != null)
    {
        $("#goBack").on('click',function (e) {
            e.preventDefault();
            window.history.back(); //this goes back to the previous window where the user was coming from...
        });
    }
    else
    {
        logout();
    }
});

const logout = () => {
    localStorage.clear();
    window.location.href = "../index.php";
};
