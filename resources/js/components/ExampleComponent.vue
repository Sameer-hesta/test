<template>
    <div class="container-fluid">
        <div class="row justify-content-left" id="accordion">
            
        </div>
        <audio id="myAudio">
            <source src="audio.mp3" type="audio/mpeg" >
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
                console.log("Req=>", e.request.bno?e.request.bno:'');
                const container = document.getElementById('accordion');

                    const card = document.createElement('div');
                    card.classList = 'card-body';

                    // Construct card content
                    const content = `
                        <div class="col-md-3" id="card-${e.request.hna}-${e.request.fno}${e.request.rno?e.request.rno:''}${e.request.r_type?e.request.r_type:''}${e.request.bno?e.request.bno:''}${e.request.b_type?e.request.b_type:''}">                        
                            <div class="card" style="color:black">
                                <div class="card-header" id="card-header-${e.request.hna}-${e.request.fno}${e.request.rno?e.request.rno:''}${e.request.r_type?e.request.r_type:''}${e.request.bno?e.request.bno:''}${e.request.b_type?e.request.b_type:''}"><h2> ${e.b_message} </h></div>
                            </div>
                            </br>
                        </div>
                    `;

                    // Append newyly created card element to the container
                    container.innerHTML += content;
                    
                    var x = document.getElementById("myAudio");
                    console.log("X =>",x);
                    x.addEventListener('ended', function() {
                        this.currentTime = 0;
                        this.volume = 1;
                        this.play();
                    }, false);
                    
                    x.play();
                    console.log(e.request.fno, 'joined', x);
            });
            
            Echo.channel('home'+userId)
            .listen('Reset', (e)=>{
                var bno = '';
                var rno = '';
                var r_type = '';
                var b_type = '';
                if(e.request.rno != undefined){
                    rno = e.request.rno
                }
                if(e.request.r_type != undefined){
                    r_type = e.request.r_type
                }
                if(e.request.bno != undefined){
                    bno = e.request.bno
                }
                if(e.request.b_type != undefined){
                    b_type = e.request.b_type
                }
                console.log("Req Can", "card-"+e.request.hna+"-"+e.request.fno+rno+r_type+bno+b_type);

                 var myobj = document.getElementById("card-"+e.request.hna+"-"+e.request.fno+rno+r_type+bno+b_type);
                    console.log(myobj);
                    myobj.remove();
                    console.log('leaved');
            });

            Echo.channel('home'+userId)
            .listen('LastLeave', (e)=>{
                var bno = '';
                var rno = '';
                var r_type = '';
                var b_type = '';
                if(e.request.rno != undefined){
                    rno = e.request.rno
                }
                if(e.request.r_type != undefined){
                    r_type = e.request.r_type
                }
                if(e.request.bno != undefined){
                    bno = e.request.bno
                }
                if(e.request.b_type != undefined){
                    b_type = e.request.b_type
                }
                console.log("Last Can", "card-"+e.request.hna+"-"+e.request.fno+rno+r_type+bno+b_type);
                
                 var myobj = document.getElementById("card-"+e.request.hna+"-"+e.request.fno+rno+r_type+bno+b_type);
                    console.log(myobj);
                    myobj.remove();
                    var x = document.getElementById("myAudio");
                    console.log("x =>y", x);
                    x.pause();

                    console.log(e.request.fno, 'Last leaved');
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
