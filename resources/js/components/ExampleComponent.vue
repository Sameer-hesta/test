<template>
    <div class="container-fluid">
        <div class="row justify-content-left">
            <div class="col-md-3">
                <div id="accordion">
    
                </div>
            </div>
        </div>
        <audio id="myAudio">
            <source src="audio.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    </div>
</template>

<script>
    export default {
        mounted() {
            var userId = document.querySelector("meta[name='user-id']").getAttribute('content');
            console.log("user",userId);
            Echo.channel('home'+userId)
            .listen('NewMessage', (e)=>{
                console.log(e);
                const container = document.getElementById('accordion');

                    const card = document.createElement('div');
                    card.classList = 'card-body';

                    // Construct card content
                    const content = `
                        <div id="card-${e.h_name}-${e.f_number}-${e.b_number}">                        
                            <div class="card">
                                <div class="card-header" id="card-deader-${e.h_name}-${e.f_number}-${e.b_number}">Patient Calling</div>
                                <h1> Bad No. ${e.b_number} is Calling...</h1>
                            </div>
                            </br>
                        </div>
                    `;

                    // Append newyly created card element to the container
                    container.innerHTML += content;
                    
                    var x = document.getElementById("myAudio");
                    console.log("X =>",x.paused);
                    x.addEventListener('ended', function() {
                        this.currentTime = 0;
                        this.play();
                    }, false);
                    
                    x.play();
                    console.log(e.b_number, 'joined', x.played);
            });
            
            Echo.channel('home'+userId)
            .listen('Reset', (e)=>{
                console.log(e.h_name);
                 var myobj = document.getElementById("card-"+e.h_name+"-"+e.f_number+"-"+e.b_number);
                    console.log(myobj);
                    myobj.remove();
                    console.log(e.b_number, 'leaved');
            });

            Echo.channel('home'+userId)
            .listen('LastLeave', (e)=>{
                console.log(e.h_name);
                 var myobj = document.getElementById("card-"+e.h_name+"-"+e.f_number+"-"+e.b_number);
                    console.log(myobj);
                    myobj.remove();
                    var x = document.getElementById("myAudio");
                    x.pause();

                    console.log(e.b_number, 'Last leaved');
            });

            Echo.join(`home`+userId)
                .here((users) => {
                    console.log("Users =>", users);
                })
                .joining((user) => {
                    console.log(user.name, 'joined');
                })
                .leaving((user) => {
                    console.log(user.name, 'leaved');
                });
            console.log('Component mounted.')
        }
    }
</script>
