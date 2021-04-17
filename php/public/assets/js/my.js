function login()
{
    var username=$("#username").val().trim();
    var password=$("#password").val().trim();
    var token = $("#_token").val();
    $.post("/login",{"username":username,'password':password,'_token':token},function(data){
        alert(data.msg);
        if(data.success)
            location.href="/adm";
    },'json');
}

function addUser()
{
    var username=$("#username").val().trim();
    var email=$("#email").val().trim();
    var password=$("#password").val();
    var password_confirmation = $("#password_confirmation").val();

    var token = $("#_token").val();
    $.post("/adm/user/add-user",{
        'username':username,
        'email':email,
        'password':password,
        'password_confirmation':password_confirmation,
        '_token':token},function(data){
        alert(data.msg);
        if(data.success)
        {
            location.href="/adm/user";
        }
    },'json')
}