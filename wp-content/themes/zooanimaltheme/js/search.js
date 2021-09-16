jQuery(document).ready(function($){
    class Search{
        constructor(){
            // alert('Search php');
            this.searchBtn = $(".search-btn");
            this.searchInput = $(".search-input");
            this.searchAnswer = $(".answer-section");
            this.events();
        }

        events(){
            this.searchBtn.on("click", this.searchInfo.bind(this));

            $(document).on("keyup", this.keyPress.bind(this))
        }

        //custome method
        keyPress(e){
            if(e.keyCode == 13){
                this.searchInfo();
            }
        }

        searchInfo(){
            this.searchAnswer.html('');
            var linkCall=zooData.root_url+'/wp-json/zooanimal/v1/search?term='+this.searchInput.val();

            $.getJSON(linkCall, (searchResult)=>{
                // console.log(searchResult);
                if(searchResult.page.length || searchResult.post.length || searchResult.captivity.length || searchResult.animal.length ||searchResult.event.length){
                    var resultShow=``;
                    if(searchResult.page.length || searchResult.captivity.length){
                        resultShow=`<div class="page-captivity-answer">`;

                        if(searchResult.page.length){
                            resultShow=resultShow+`
                            <div>
                                <label class="label-search">Pages</label>
                                <ul>
                                    ${searchResult.page.map(item => `
                                        <li><a class="captive-h3" href="${item.permalink}">${item.title}</a></li>
                                    `).join('')}
                                    
                                </ul>
                            </div>`;
                        }

                        if(searchResult.captivity.length){
                            resultShow=resultShow+`<div>
                            <label class="label-search">Captivity</label>
                                <ul>
                                    ${searchResult.captivity.map(item => `
                                    <li><a class="captive-h3" href="${item.permalink}">${item.title}</a></li>
                                    `).join('')}
                                </ul>
                            </div>`;
                        }

                        resultShow=resultShow+`</div>`;

                    }

                    if(searchResult.post.length){
                        resultShow=resultShow+`
                        <label class="label-search">Blog:</label>
                        <div class="blog-main">
                            ${searchResult.post.map(item => `
                            <div class="singleBlog" style="text-align:center">
                                <img class="cover" src="${item.thumbnail}"/>
                                <div class="blogContent">
                                    <p>${item.title}</p>
                                    <a href="${item.permalink}" class="btn-blog">Read More</a>
                                </div>
                            </div>`).join('')}
                            
                        </div>
                        `;
                    }

                    if(searchResult.animal.length){
                        resultShow=resultShow+`
                        <label class="label-search">Animal:</label>
                        <div class="blog-main">
                            ${searchResult.animal.map(item => `<div class="singleBlog" style="text-align:center">
                            <img class="cover" src="${item.thumbnail}"/>
                            <div class="blogContent">
                                <p>${item.title}</p>
                                <a href="${item.permalink}" class="btn-blog">Read More</a>
                            </div>
                        </div>`).join('')}
                            
                        </div>
                        `;
                    }

                    if(searchResult.event.length){
                        resultShow = resultShow + `<label class="label-search">Events</label>
                        <div class="events" style="padding:0; margin: 0">
                            <ul>
                                ${searchResult.event.map(item=>`
                                    <li style="padding: 1rem 2rem; min-height: 20rem">
                                        <div class="timeEvent">
                                            <h2>${item.day}<br /><span>${item.month}</span></h2>
                                        </div>
                                        <div class="detailEvent">
                                            <h3>${item.title}</h3>
                                            <p>${item.description}</p>
                                            <a href="${item.permalink}"><span>View Details</span></a>
                                        </div>
                                        <div style="clear: both;"></div>
                                    </li>
                                `).join('')}   
                            </ul>
                        </div>`;
                    }

                    this.searchAnswer.html(resultShow);

                }else{
                    this.searchAnswer.html('<p>Sorry we cannot find those information</p>');
                }
                
            })

            // alert('search for '+linkCall);
        }

    }

    search=new Search();
});

