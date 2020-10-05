$(document).ready(() =>{
    const userDetails = JSON.parse(localStorage.getItem('userDetails'));
    if (userDetails != null)
    {
        //TODO asynchronously load the post for the user
        //TODO create a infinite scroll that keeps loading new content
        //TODO show a loading symbol while the data is being fetched
        //TODO make sure to display in reverse chronological order
        //TODO add relevant event listens for when user wants to view the post or the user profile who posted it
        //TODO make sure to make correct use of the data attribute in html to store the relevant ID's
        //TODO when adding new images alternate between the diff coulombs

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
