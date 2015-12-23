<?php
require ("./header.html");
require ("api/get_polls.php");
?>

<script language="javascript">   
  function checkfrom()   
  {   
      var cnt = 0;
      // var str="";
      var chk=document.getElementsByName("vote[]");
      for(var i=0;i<chk.length;i++)
      {
           if(chk[i].checked)
           {
                // str+=chk[i].value+",";//得到用逗号分割的字符串
                cnt++;
           }
       }
       if(cnt<5)
    {
      alert("投票人数小于5人，请选择5-10个候选人");
      return false;
    }
    else if(cnt>10)
    {
      alert("投票人数大于10人，请选择5-10个候选人");
      return false;
    } 
    else
      return true;
  }  
 //   function checkfrom()
 // {
 //      return confirm('提交投票结果?');
 // }
  </script>

<style>
    .get {
      background: #1E5B94;
      color: #fff;
      text-align: center;
      padding: 100px 0;
    }

    .get-title {
      font-size: 200%;
      border: 2px solid #fff;
      padding: 20px;
      display: inline-block;
    }

    .get-btn {
      background: #fff;
    }

    .detail {
      background: #fff;
    }

    .detail-h2 {
      text-align: center;
      font-size: 150%;
      margin: 40px 0;
    }

    .detail-h3 {
      color: #1f8dd6;
    }

    .detail-p {
      color: #7f8c8d;
    }

    .detail-mb {
      margin-bottom: 30px;
    }

    .hope {
      background: #0bb59b;
      padding: 50px 0;
    }

    .hope-img {
      text-align: center;
    }

    .hope-hr {
      border-color: #149C88;
    }

    .hope-title {
      font-size: 140%;
    }

    .about {
      background: #fff;
      padding: 40px 0;
      color: #7f8c8d;
    }

    .about-color {
      color: #34495e;
    }

    .about-title {
      font-size: 180%;
      padding: 30px 0 50px 0;
      text-align: center;
    }

    .footer p {
      color: #7f8c8d;
      margin: 0;
      padding: 15px 0;
      text-align: center;
      background: #2d3e50;
    }
  </style>
</head>
<body>

<div class="get">
  <div class="am-g">
    <div class="am-u-lg-12">
      <h1 class="get-title">南京邮电大学十佳志愿者评选</h1>

      <p>
        <p>南京邮电大学2015年度十佳青年志愿者评选，经过校团委评审委员会的层层筛选，最终20位同学入围十佳志愿者网络在线评选。</p>
        <p>主办：共青团南京邮电大学委员会</p>
        <p>承办：青年志愿者联合会</p>
        <p>投票起止日期：2015-12-11 08：00 ---  2015-12-18 08：00</p>
      </p>
    </div>
  </div>
</div>

<div class="detail">
  <div class="am-g am-container">
    <div class="am-u-lg-12">
      <h3 class="detail-h2">规则：每次至少投5-10人，每天每IP限投票一次。</h3>
<form name="voting" action="./vote.php" method="post" onSubmit="return checkfrom()">
      <div class="am-g">
<div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">

          <div data-am-widget="intro"
       class="am-intro am-cf am-intro-default"
       >
      <div class="am-intro-hd">
        <h2 class="am-intro-title">1</h2>
            <a class="am-intro-more am-intro-more-top " href="/1.php">查看事迹简介</a>
      </div>

    <div class="am-g am-intro-bd">
        <div
          class="am-u-lg-12"><img src="/1.jpg" alt="1" /></div>
        <div
            class="am-u-lg-12"><p><br></p></div>
    </div>
    <div class="am-intro-more-bottom">
        <div><p>实时票数：<?php echo get_polls(1);?><br><input type="checkbox" name="vote[]" onclick="checkit(this)" value="1" >
&nbsp; 选择他</p>
        </div>
      </div>
  </div>
        </div>
<div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">

          <div data-am-widget="intro"
       class="am-intro am-cf am-intro-default"
       >
      <div class="am-intro-hd">
        <h2 class="am-intro-title">2</h2>
            <a class="am-intro-more am-intro-more-top " href="/2.php">查看事迹简介</a>
      </div>

    <div class="am-g am-intro-bd">
        <div
          class="am-u-lg-12"><img src="/2.jpg" alt="2" /></div>
        <div
            class="am-u-lg-12"><p><br>2号候选人：<br></p></div>
    </div>
    <div class="am-intro-more-bottom">
        <div><p>实时票数：<?php echo get_polls(2);?><br><input type="checkbox" name="vote[]" onclick="checkit(this)" value="2" >
&nbsp; 选择他</p>
        </div>
      </div>
  </div>
        </div>
 <div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">

          <div data-am-widget="intro"
       class="am-intro am-cf am-intro-default"
       >
      <div class="am-intro-hd">
        <h2 class="am-intro-title">3</h2>
            <a class="am-intro-more am-intro-more-top " href="/3.php">查看事迹简介</a>
      </div>

    <div class="am-g am-intro-bd">
        <div
          class="am-u-lg-12"><img src="/3.jpg" alt="3" /></div>
        <div
            class="am-u-lg-12"><p><br>3号候选人：<br></p></div>
    </div>
    <div class="am-intro-more-bottom">
        <div><p>实时票数：<?php echo get_polls(3);?><br><input type="checkbox" name="vote[]" onclick="checkit(this)" value="3" >
&nbsp; 选择他</p>
        </div>
      </div>
  </div>
        </div>
      </div>
<!-- <header class="am-topbar am-topbar-fixed-top">
  <div class="am-container">      
      <div class="am-topbar-right">
        <input type="submit" value="提交投票" class="am-btn am-btn-secondary am-topbar-btn am-btn-sm am-btn-default ">
      </div>
    </div>
    </div>
  </div>
</header> -->
<header data-am-widget="header"
          class="am-header am-header-default am-header-fixed">
          <div class="am-container">
      <div class="am-header-left am-header-nav">
          <a href="/index.php" class="">

              <img class="am-header-icon-custom" src="data:image/svg+xml;charset=utf-8,&lt;svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 12 20&quot;&gt;&lt;path d=&quot;M10,0l2,2l-8,8l8,8l-2,2L0,10L10,0z&quot; fill=&quot;%23fff&quot;/&gt;&lt;/svg&gt;" alt=""/>
          </a>
      </div>
      <div class="am-header-right am-header-nav">
          <input type="submit" value="提交投票" class="am-btn am-btn-secondary am-topbar-btn am-btn-sm am-round ">
      </div>
      <h1 class="am-header-title">
          <img src="head.png" />
      </h1>
      </div> 
  </header>
    </form>
    </div>
  </div>
</div>
<div class="amz-toolbar" id="amz-toolbar" style="right: 119.5px;">
  <div data-am-widget="gotop" class="am-gotop am-gotop-fixed" >
    <a href="#top" title="回到顶部">
        <span class="am-gotop-title">回到顶部</span>
          <i class="am-gotop-icon am-icon-chevron-up"></i>
    </a>
  </div>
</div>
<div class="hope">
  <div class="am-g am-container">
    <div class="am-u-lg-4 am-u-md-6 am-u-sm-12 hope-img">
      <img src="assets/i/examples/landing.png" alt="" data-am-scrollspy="{animation:'slide-left', repeat: false}">
      <hr class="am-article-divider am-show-sm-only hope-hr">
    </div>
    <div class="am-u-lg-8 am-u-md-6 am-u-sm-12">
      <h2 class="hope-title">更多志愿咨询，请关注微信公众号：南邮青志联（nyqzl_2008）</h2>


    </div>
  </div>
</div>

<?php
require ("./footer.html");
?>
