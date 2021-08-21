 
<script src="public/jquery-3.2.1.min.js"></script>
<form method="POST" id="myform"  name="applicationblank" enctype='multipart/form-data'  >                    
    <div class="input-field col s6">                                     
    <input id="nameref0" name="nameref0[]" class="validate" type="text">
    <label for="nameref0">Reference 1</label>
    <input id="nameref0" name="nameref0[]" class="validate" type="text" >
    <label for="nameref0">Reference 2</label>
    <input type="button" class="btn blue darken-1" value="Upload" id="submitformdata"> </input>
                                        
    </div>
</form>

<script>
$("#submitformdata").click(function () 
{
    users = []
    i=0
           $('input[name^="nameref0"]').each(function() {
               users[i] = $(this).val();
                i++;
            });
            for(let i=0;i<users.length;i++)
            {
                alert(users[i])
            }
})

</script>