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
            Echo.channel('home'.{userId})
            .listen('NewMessage', (e)=>{
                console.log(e.h_name);
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
            
            Echo.channel('home')
            .listen('Reset', (e)=>{
                console.log(e.h_name);
                 var myobj = document.getElementById("card-"+e.h_name+"-"+e.f_number+"-"+e.b_number);
                    console.log(myobj);
                    myobj.remove();
                    var x = document.getElementById("myAudio");
                    x.pause();

                    console.log(e.b_number, 'leaved');
            });

            Echo.join(`chat`)
                .here((users) => {
                    console.log("Users =>", users);
                })
                .joining((user) => {
                    
                    const container = document.getElementById('accordion');

                    const card = document.createElement('div');
                    card.classList = 'card-body';

                    // Construct card content
                    const content = `
                        <div class="card" id="card-${user.id}">
                            <div class="card-header" id="card-deader-${user.id}">Patient Calling</div>
                            <h2> Bad No. ${user.id} is Calling </h2>
                        </div>
                        </br>
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
                    console.log(user.name, 'joined', x.played);
                })
                .leaving((user) => {
                    var myobj = document.getElementById("card-"+user.id);
                    console.log(myobj);
                    myobj.remove();
                    var x = document.getElementById("myAudio");
                    x.pause();
                    console.log(user.name, 'leaved');
                });
            console.log('Component mounted.')
        }
    }
</script>
