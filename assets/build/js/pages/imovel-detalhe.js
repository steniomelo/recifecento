!function(n){n("a.vizinhanca").on("shown.bs.tab",(function(n){streetView(),n.target,n.relatedTarget})),n("[data-destaque-galeria]").slick({infinite:!1,autoplay:!1,slidesToShow:1,pauseOnHover:!1,pauseOnFocus:!1,arrows:!0,dots:!0,lazyLoad:"ondemand",prevArrow:n(".arrow-prev"),nextArrow:n(".arrow-next"),appendDots:n(".imovel-header__dots")}),n(document).on("nfFormReady",(function(){n(".imovel-btn").on("click",(function(o){return o.preventDefault(),window.scroll({top:n("#vamosnegociar").offset().top,left:0,behavior:"smooth"}),n(window).on("scroll",(function(){n(window).scrollTop()==n("#vamosnegociar").offset().top&&n(".input_nome").focus()})),!1}))})),n(".simulation-tabs li").click((function(){var o=n(this).index();n(this).closest(".simulation-tabs").find("li").removeClass("current"),n(this).closest("li").addClass("current"),0===o&&(n("#nf-form-1-cont, #nf-form-5-cont").addClass("show"),n("#nf-form-6-cont, #nf-form-7-cont").removeClass("show")),1===o&&(n("#nf-form-6-cont, #nf-form-7-cont").addClass("show"),n("#nf-form-1-cont, #nf-form-5-cont").removeClass("show"))})),n(document).on("nfFormReady",(function(o,e){n("#nf-form-1-cont, #nf-form-5-cont").addClass("show"),n("#nf-form-1-cont #nf-field-7, #nf-form-5-cont #nf-field-31").val(n("#vamosnegociar").data("codigo")),n("#nf-form-6-cont #nf-field-38, #nf-form-7-cont #nf-field-47").val(n("#vamosnegociar").data("codigo")),"#nf-form-1-cont"===e.el&&n("#nf-field-4").click((function(){""!=n("#nf-form-1-cont .input_nome").val()&&""!=n("#nf-form-1-cont .input_email").val()&&""!=n("#nf-form-1-cont .input_telefone").val()&&""!=n("#nf-form-1-cont .input_proposta").val()&&n.ajax({type:"POST",url:"http://leads.ingaia.com.br/leads/integration",data:{reference:n("#vamosnegociar").data("codigo"),registerDate:(new Date).toISOString(),name:n("#nf-form-1-cont .input_nome").val(),email:n("#nf-form-1-cont .input_email").val(),phone:n("#nf-form-1-cont .input_telefone").val(),message:"Código do Imóvel: "+n("#vamosnegociar").data("codigo")+", Valor da Proposta: "+n("#nf-form-1-cont .input_proposta").val()},headers:{Authorization:"Basic ZWQzOS0xNTUwNjk0OTQ3MDgxLTQwNTMyLTg="},error:function(n){console.log("Erro! Algo inesperado aconteceu.")}})})),"#nf-form-6-cont"===e.el&&n("#nf-field-35").click((function(){""!=n("#nf-form-6-cont .input_nome").val()&&""!=n("#nf-form-6-cont .input_email").val()&&""!=n("#nf-form-6-cont .input_telefone").val()&&""!=n("#nf-form-6-cont .input_financiamento").val()&&""!=n("#nf-form-6-cont .input_renda").val()&&n.ajax({type:"POST",url:"http://leads.ingaia.com.br/leads/integration",data:{reference:n("#vamosnegociar").data("codigo"),registerDate:(new Date).toISOString(),name:n("#nf-form-6-cont .input_nome").val(),email:n("#nf-form-6-cont .input_email").val(),phone:n("#nf-form-6-cont .input_telefone").val(),message:"Código do Imóvel: "+n("#vamosnegociar").data("codigo")+", Valor do Financiamento: "+n("#nf-form-6-cont .input_financiamento").val()+", Renda Mensal: "+n("#nf-form-6-cont .input_renda").val()},headers:{Authorization:"Basic ZWQzOS0xNTUwNjk0OTQ3MDgxLTQwNTMyLTg="},error:function(n){console.log("Erro! Algo inesperado aconteceu.")}})})),"#nf-form-5-cont"===e.el&&n("#nf-field-28").click((function(){""!=n("#nf-form-5-cont .input_nome").val()&&""!=n("#nf-form-5-cont .input_email").val()&&""!=n("#nf-form-5-cont .input_telefone").val()&&""!=n("#nf-form-5-cont .input_proposta").val()&&n.ajax({type:"POST",url:"http://leads.ingaia.com.br/leads/integration",data:{reference:n("#vamosnegociar").data("codigo"),registerDate:(new Date).toISOString(),name:n("#nf-form-5-cont .input_nome").val(),email:n("#nf-form-5-cont .input_email").val(),phone:n("#nf-form-5-cont .input_telefone").val(),message:"Código do Imóvel: "+n("#vamosnegociar").data("codigo")+", Valor da Proposta: "+n("#nf-form-5-cont .input_proposta").val()},headers:{Authorization:"Basic ZWQzOS0xNTUwNjk0OTQ3MDgxLTQwNTMyLTg="},error:function(n){console.log("Erro! Algo inesperado aconteceu.")}})})),"#nf-form-7-cont"===e.el&&n("#nf-field-44").click((function(){""!=n("#nf-form-7-cont .input_nome").val()&&""!=n("#nf-form-7-cont .input_email").val()&&""!=n("#nf-form-7-cont .input_telefone").val()&&""!=n("#nf-form-7-cont .input_financiamento").val()&&""!=n("#nf-form-7-cont .input_renda").val()&&n.ajax({type:"POST",url:"http://leads.ingaia.com.br/leads/integration",data:{reference:n("#vamosnegociar").data("codigo"),registerDate:(new Date).toISOString(),name:n("#nf-form-7-cont .input_nome").val(),email:n("#nf-form-7-cont .input_email").val(),phone:n("#nf-form-7-cont .input_telefone").val(),message:"Código do Imóvel: "+n("#vamosnegociar").data("codigo")+", Valor do Financiamento: "+n("#nf-form-7-cont .input_financiamento").val()+", Renda Mensal: "+n("#nf-form-7-cont .input_renda").val()},headers:{Authorization:"Basic ZWQzOS0xNTUwNjk0OTQ3MDgxLTQwNTMyLTg="},error:function(n){console.log("Erro! Algo inesperado aconteceu.")}})}))})),n(".btn-telefone").click((function(){console.log(n(this).parents(".info-telefone").find(".telefone a").html()),n(this).parents(".info-telefone").find(".telefone").show(),ga("send","event","Telefone","Visualizar",n(this).parents(".info-telefone").find(".telefone a").html()),dataLayer.push({event:"Telefone"}),gtag("event","Ver telefone do estabelecimento",{event_category:"Telefone",event_label:n(this).parents(".info-telefone").find(".telefone").data("nome"),value:n(this).parents(".info-telefone").find(".telefone a").html()})}))}(jQuery);