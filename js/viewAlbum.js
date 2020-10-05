$(document).ready(() =>{
    const userDetails = JSON.parse(localStorage.getItem('userDetails'));
    if (userDetails != null)
    {
        $(".img").on('click',function () {
            window.location.href = "./post.php";
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
