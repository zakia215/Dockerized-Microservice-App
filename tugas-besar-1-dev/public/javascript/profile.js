
const util = new Util();
document.getElementById('deleteUser').addEventListener('click', async(e) =>{
    e.preventDefault();
    if(confirm('Are you sure you want to delete your account?')){
        const response = await util.delete('/api/profile/'+ user_id);
        window.location.href = "/logout";
    }

});
