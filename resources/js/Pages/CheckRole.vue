
    <style scoped>
      .page_404{ padding:40px 0; background:#fff; font-family: 'Arvo', serif;
      }

      .page_404  img{ width:100%;}

      .restricted_page{
      background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
      height: 400px;
      width: 100%;
      background-position: center;
      }


      .restricted_page h1{
      font-size:80px;
      }

      .restricted_page h3{
        font-size:80px;
        }
        
        .link_404{			 
      color: #fff!important;
      padding: 10px 20px;
      background: #39ac31;
      margin: 20px 0;
      display: inline-block;}
      .contant_box_404{ margin-top:-50px;}

      .verifying_page{
      background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
      height: 400px;
      width: 100%;
      background-position: center;
      }
    </style>

<template>

  <div class="px-5 pt-5" v-if="this.$page.props.errors.hasOwnProperty('message') && this.$page.props.errors.message == 'Restricted Access!'">
    <h1>Restricted Area</h1>
    <h4 class="text-secondary"> You are unauthorize to access this page.
      Please be advised that you will be redicrected to your assigned page.
    </h4>
  </div>

  <div class="px-5 pt-5" v-else>
    <h1>Verifying your User Access</h1>
    <h4 class="text-secondary">
      Please be advised that you will be redicrected to your assigned page.
    </h4>
  </div>
</template>


<script>
    export default {
		props: {
      CheckRoleData: null,
    },
    methods: {
        checkRoleFunc(){
          console.log(this.$page.props.user.user_type);
            setTimeout(() => {
                window.location.href="/"+this.$page.props.user.user_type;
            }, 3000);
        },
    },
    created: function(){
        this.checkRoleFunc();
    },
}
</script>
