<?php
error_reporting (E_ALL);
ini_set('display_errors',1);
require_once('page.inc.php');
$page = new page('Sample Page');
$page->set_features(array(PIWIK,FORMS,FANCY_BOX));
$page->add_css('path/to/my/style.css');
echo $page->head();
?>
<header class="navbar"></header>
<article>
  <section id="hero">
    <div class="container cf">
      <h1>HTML MARKUP HERE</h1>
    </div>
  </section>
  <div class="container cf">
    <div class="row">
      <div class="col-md-2">
        <h2>In This Page</h2>
        <ul>
          <li><a href="#">link 1</a></li>
          <li><a href="#">link 2</a></li>
          <li><a href="#">link 3</a></li>
          <li><a href="#">link 4</a></li>
          <li><a href="#">link 5</a></li>
        </ul>
      </div>
      <div class="col-md-7">
<h2>Stuff</h2>
<p>Look, there's a rhythmic ceremonial ritual coming up. He's a very strange young man. Don't tell me anything. I can't play. Doc, Doc. Oh, no. You're alive. Bullet proof vest, how did you know, I never got a chance to tell you. About all that talk about screwing up future events, the space time continuum.</p>
<p>Your, your right. Well, they're bigger than me. I can't play. What you got under here? No wait, Doc, the bruise, the bruise on your head, I know how that happened, you told me the whole story. you were standing on your toilet and you were hanging a clock, and you fell, and you hit your head on the sink, and that's when you came up with the idea for the flux capacitor, which makes time travel possible.</p>
<p>Chuck, Chuck, its' your cousin. Your cousin Marvin Berry, you know that new sound you're lookin for, well listen to this. Now, of course not, Biff, now, I wouldn't want that to happen. You wanna a Pepsi, pall, you're gonna pay for it. Don't pay any attention to him, he's in one of his moods. Sam, quit fiddling with that thing, come in here to dinner. Now let's see, you already know Lorraine, this is Milton, this is Sally, that's Toby, and over there in the playpen is little baby Joey. Right, gimme a Pepsi free.</p>
<hr/>
<h2>Other Stuff</h2>
<p>Look, there's a rhythmic ceremonial ritual coming up. He's a very strange young man. Don't tell me anything. I can't play. Doc, Doc. Oh, no. You're alive. Bullet proof vest, how did you know, I never got a chance to tell you. About all that talk about screwing up future events, the space time continuum.</p>
<p>Your, your right. Well, they're bigger than me. I can't play. What you got under here? No wait, Doc, the bruise, the bruise on your head, I know how that happened, you told me the whole story. you were standing on your toilet and you were hanging a clock, and you fell, and you hit your head on the sink, and that's when you came up with the idea for the flux capacitor, which makes time travel possible.</p>
<p>Chuck, Chuck, its' your cousin. Your cousin Marvin Berry, you know that new sound you're lookin for, well listen to this. Now, of course not, Biff, now, I wouldn't want that to happen. You wanna a Pepsi, pall, you're gonna pay for it. Don't pay any attention to him, he's in one of his moods. Sam, quit fiddling with that thing, come in here to dinner. Now let's see, you already know Lorraine, this is Milton, this is Sally, that's Toby, and over there in the playpen is little baby Joey. Right, gimme a Pepsi free.</p>

      </div>
      <div class="col-md-3">
<h2>Side</h2>
<p>What did I just say? Don't worry. As long as you hit that wire with the connecting hook at precisely 88 miles per hour, the instance the lightning strikes the tower, everything will be fine. Working. No no no no no, Marty, both you and Jennifer turn out fine. It's your kids, Marty, something has got to be done about your kids. Radiation suit, of course, cause all of the fall out from the atomic wars. This is truly amazing, a portable television studio. No wonder your president has to be an actor, he's gotta look good on television.</p>
      </div>
    </div>
  </div>
</article>
<footer>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h2>LSITO <small>Web Development Team</small></h2>
        <address>University of Wisconsin&ndash;Milwaukee<br/>Holton Hall (check the basement…over by the water heater…and the sump pump)</address>
      </div>
    </div>
  </div>
</footer>

<?php
echo $page->foot();
?>

