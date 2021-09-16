jQuery(document).ready(function($){
    class Booking{
        constructor(){
            this.adultTicket = $(".adult-ticket");
            this.childTicket = $(".child-ticket");
            this.btnCheckPrice = $(".check-price");
            this.btnBooking = $(".book-ticket");
            this.pricePlace = $(".price-place");
            this.inputDiv = $(".input-ticket-div");
            this.bookingResult=$(".bookingResult");
            this.cancelBtn=$(".book-cancel");
            this.ticketDiv=$(".ticketPart");
            this.events();
        }

        events(){
            this.btnCheckPrice.on("click", this.checkPrice.bind(this));
            this.btnBooking.on("click", this.bookingTicket.bind(this));
            this.cancelBtn.on("click", this.cancelTicket.bind(this));
            
        }

        // method

        checkPrice(){
            this.pricePlace.html('');
            var priceAdult = this.inputDiv.attr("data-adult");
            var priceChild = this.inputDiv.attr("data-child");
            var totalPrice= 0;;
            if(priceAdult && priceChild){
                totalPrice = priceAdult * this.adultTicket.val()+ priceChild * this.childTicket.val();
            }else{
                if(priceAdult){
                    totalPrice= (this.adultTicket.val()+this.childTicket.val())*priceAdult;
                }else{
                    totalPrice= (this.adultTicket.val()+this.childTicket.val())*priceChild;
                }
            }
            this.pricePlace.html(''+totalPrice);
        }

        cancelTicket(e){
            var currentCancelBox = $(e.target.closest(".book-cancel"));
            var ticketID=currentCancelBox.attr("data-ticketid");
            var thisTicket=$(e.target).parents(".ticketPart");
            $.ajax({
                beforeSend: (xhr)=>{
                    xhr.setRequestHeader('X-WP-Nonce',zooData.nonce)
                },
                url: zooData.root_url+'/wp-json/zooanimal/v1/manageTicket',
                type:'PUT',
                data: { ticketID},
                success:(response)=>{
                    if(response){
                        thisTicket.slideUp();
                    }
                },
                error: (error)=>{
                    console.log(error);
                }
            })
        }

        bookingTicket(){
            var adultTicketSend = 0;
            var childTicketSend=0;
            if(this.adultTicket.val().length){
                adultTicketSend = this.adultTicket.val();
            }

            if(this.childTicket.val().length){
                childTicketSend = this.childTicket.val();
            }

            if(adultTicketSend || childTicketSend){
                var dataSend = {
                    'eventID': this.inputDiv.attr("data-eventid"),
                    'adultTicket':adultTicketSend,
                    'childTicket':childTicketSend
                }
                
                $.ajax({
                    beforeSend: (xhr)=>{
                        xhr.setRequestHeader('X-WP-Nonce',zooData.nonce)
                    },
                    url: zooData.root_url+'/wp-json/zooanimal/v1/manageTicket',
                    type:'POST',
                    data: dataSend,
                    success:(response)=>{
                        if(response){
                            this.bookingResult.html('Thank you for booking our events, we have send the bill to your email');
                        }else{
                            this.bookingResult.html('Sorry our available tickets is not enough for your request');
                        }

                        console.log(response);
                    },
                    error: (error)=>{
                        console.log(error);
                    }
                })
            }
            
        }

    }

    booking = new Booking();
});