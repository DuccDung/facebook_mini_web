<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Profile - Demo</title>

  <!-- optional icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root{
      --blue:#1877f2;
      --bg:#f0f2f5;
      --card:#fff;
      --muted:#65676b;
      --radius:12px;
      --container:1100px;
    }
    *{box-sizing:border-box}
    body{
      margin:0;
      font-family: "Helvetica Neue", Arial, sans-serif;
      background:var(--bg);
      color:#111;
      -webkit-font-smoothing:antialiased;
    }

    /* wrapper */
    .wrap{
      max-width:var(--container);
      margin:24px auto;
      padding:0 16px;
    }

    /* cover */
    .cover {
      height:320px;
      background:linear-gradient(180deg,#e9edf2,#eef1f4);
      border-radius: var(--radius);
      overflow:hidden;
      position:relative;
      box-shadow: 0 1px 0 rgba(0,0,0,0.06);
    }
    .cover img{
      width:100%;
      height:100%;
      object-fit:cover;
      display:block;
    }

    /* header block overlapping cover */
    .profile-header{
      background: transparent;
      margin-top:-90px; /* pull up */
      display:flex;
      gap:24px;
      align-items:flex-end;
      padding: 0 6px;
    }

    .avatar-wrap{
      width:184px;
      min-width:184px;
      height:184px;
      border-radius:50%;
      background:#e9ecef;
      border:6px solid var(--card);
      box-shadow:0 4px 12px rgba(0,0,0,0.06);
      display:flex;
      align-items:center;
      justify-content:center;
      overflow:hidden;
    }
    .avatar-wrap img{ width:100%; height:100%; object-fit:cover; }

    .profile-main{
      flex:1;
      background:var(--card);
      border-radius: var(--radius);
      padding:18px 20px;
      box-shadow:0 1px 0 rgba(0,0,0,0.04);
    }

    .profile-name{
      font-size:30px;
      font-weight:700;
      margin:6px 0 6px;
    }
    .profile-meta{
      color:var(--muted);
      margin-bottom:12px;
    }

    .mutuals {
      display:flex;
      gap:8px;
      align-items:center;
      margin-bottom:14px;
    }
    .mutuals img{ width:36px; height:36px; border-radius:50%; border:2px solid #fff; box-shadow:0 0 0 1px rgba(0,0,0,0.04); }

    .profile-actions{
      display:flex;
      gap:10px;
      align-items:center;
      margin-top:6px;
    }

    .btn {
      border:0;
      padding:10px 16px;
      border-radius:10px;
      font-weight:600;
      cursor:pointer;
    }
    .btn-primary{ background:var(--blue); color:#fff; }
    .btn-ghost{ background:#e9ecef; color:#111; }
    .btn-small{ padding:8px 10px; border-radius:9px; }

    /* tabs */
    .tabs{
      margin-top:16px;
      background:var(--card);
      border-radius:var(--radius);
      padding:8px 12px;
      display:flex;
      gap:18px;
      align-items:center;
      box-shadow:0 1px 0 rgba(0,0,0,0.04);
      margin-bottom:18px;
    }
    .tab{
      padding:8px 10px;
      color:var(--muted);
      cursor:pointer;
      border-radius:8px;
      font-weight:600;
    }
    .tab.active{ color:var(--blue); border-bottom:2px solid var(--blue); }

    /* page sections */
    .section{
      margin-top:18px;
      background:var(--card);
      border-radius:var(--radius);
      padding:18px;
      box-shadow:0 1px 0 rgba(0,0,0,0.04);
    }
    .section .header{
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin-bottom:14px;
    }
    .section h3{ margin:0; font-size:20px; }
    .see-all{ color:var(--blue); font-weight:600; text-decoration:none; }

    /* photos grid */
    .photos-grid{
      display:grid;
      grid-template-columns:repeat(3,1fr);
      gap:12px;
    }
    .photos-grid img{
      width:100%;
      height:160px;
      object-fit:cover;
      border-radius:10px;
    }

    /* friends grid */
    .friends-grid{
      display:grid;
      grid-template-columns:repeat(3,1fr);
      gap:12px;
      align-items:start;
    }
    .friend-card{
      display:block;
      text-decoration:none;
      color:inherit;
    }
    .friend-card .photo{
      width:100%;
      height:140px;
      background:#e9ecef;
      border-radius:10px;
      overflow:hidden;
      margin-bottom:8px;
    }
    .friend-card img{ width:100%; height:100%; object-fit:cover; display:block; }
    .friend-name{ font-weight:600; margin:0; }

    /* post card */
    .post{
      border-radius:12px;
      overflow:hidden;
      background:var(--card);
      margin-bottom:14px;
      box-shadow:0 1px 0 rgba(0,0,0,0.04);
    }
    .post-header{
      display:flex;
      gap:12px;
      padding:12px;
      align-items:center;
    }
    .post-header img{ width:48px; height:48px; border-radius:50%; }
    .post-body{ padding:0 12px 12px 12px; }
    .post-text{ margin:8px 0 12px; color:#111; line-height:1.45; }
    .post-img{
      width:100%;
      display:block;
      max-height:600px;
      object-fit:cover;
    }
    .post-actions{ padding:10px 12px; display:flex; gap:14px; color:var(--muted); font-weight:600; }

    /* responsive */
    @media (max-width:900px){
      .wrap{ margin:0; padding:0; max-width:100%; }
      .cover{ height:220px; border-radius:0; }
      .profile-header{ margin-top:-70px; padding: 0 12px; gap:14px;}
      .avatar-wrap{ width:120px; height:120px; min-width:120px; }
      .profile-name{ font-size:22px; }
      .profile-main{ padding:14px; }
      .tabs{ gap:10px; overflow:auto; padding:8px; border-radius:0;}
      .photos-grid, .friends-grid{ grid-template-columns:repeat(2,1fr); }
      .friend-card .photo{ height:120px; }
      .profile-main{ border-radius:0; }
    }
  </style>
</head>
<body>

  <div class="wrap">

    <!-- COVER -->
    <div class="cover" id="cover">
      <!-- sample cover image (replace with dynamic url) -->
      <img src="https://images.unsplash.com/photo-1503264116251-35a269479413?q=80&w=1600&auto=format&fit=crop&ixlib=rb-4.0.3&s=4b0b2b5aea1b4e9b1f1060f129d5d74c" alt="cover">
    </div>

    <!-- PROFILE HEADER (avatar + name + actions) -->
    <div class="profile-header" role="region" aria-label="profile header">
      <div class="avatar-wrap" id="avatarWrap">
        <img src="https://i.pravatar.cc/400?img=12" alt="avatar">
      </div>

      <div class="profile-main">
        <div>
          <div class="profile-name" id="profileName">Đỗ Hạnh</div>
          <div class="profile-meta" id="profileMeta">644 người bạn • 83 bạn chung</div>

          <div class="mutuals" id="mutuals">
            <!-- small friend thumbs -->
            <img src="https://i.pravatar.cc/40?img=1" alt="">
            <img src="https://i.pravatar.cc/40?img=2" alt="">
            <img src="https://i.pravatar.cc/40?img=3" alt="">
            <img src="https://i.pravatar.cc/40?img=4" alt="">
            <img src="https://i.pravatar.cc/40?img=5" alt="">
          </div>
        </div>

        <div class="profile-actions" id="profileActions">
          <button class="btn btn-primary"><i class="fa-solid fa-user-plus" style="margin-right:8px"></i>Thêm bạn bè</button>
          <button class="btn btn-ghost"><i class="fa-solid fa-message" style="margin-right:8px"></i>Nhắn tin</button>
          <button class="btn btn-ghost btn-small"><i class="fa-solid fa-ellipsis"></i></button>
        </div>

      </div>
    </div>

    <!-- TABS -->
    <div class="tabs" role="tablist" aria-label="profile tabs">
      <div class="tab active" data-tab="posts">Bài viết</div>
      <div class="tab" data-tab="about">Giới thiệu</div>
      <div class="tab" data-tab="friends">Bạn bè</div>
      <div class="tab" data-tab="photos">Ảnh</div>
      <div class="tab" data-tab="checkin">Check in</div>
      <div class="tab" data-tab="more">Xem thêm ▾</div>
    </div>

    <!-- PHOTOS SECTION -->
    <div class="section" id="photosSection">
      <div class="header">
        <h3>Ảnh</h3>
        <a class="see-all" href="#">Xem tất cả ảnh</a>
      </div>

      <div class="photos-grid" id="photosGrid">
        <img src="https://images.unsplash.com/photo-1503264116251-35a269479413?q=80&w=800&auto=format&fit=crop&ixlib=rb-4.0.3&s=4b0b2b5aea1b4e9b1f1060f129d5d74c" alt="">
        <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?q=80&w=800&auto=format&fit=crop&ixlib=rb-4.0.3&s=2d0b3f9557f8e3e6b98d2c6e108d0e7f" alt="">
        <img src="https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?q=80&w=800&auto=format&fit=crop&ixlib=rb-4.0.3&s=ea3f9b1f3f6dbb3c2f6f20b1ea7eb6a6" alt="">
      </div>
    </div>

    <!-- FRIENDS SECTION -->
    <div class="section" id="friendsSection">
      <div class="header">
        <h3>Bạn bè</h3>
        <a class="see-all" href="#">Xem tất cả bạn bè</a>
      </div>

      <p style="color:var(--muted); margin:0 0 12px">83 bạn chung</p>

      <div class="friends-grid" id="friendsGrid">
        <a class="friend-card" href="#" data-userid="101">
          <div class="photo"><img src="https://i.pravatar.cc/300?img=15" alt=""></div>
          <p class="friend-name">Thu Hương</p>
        </a>
        <a class="friend-card" href="#" data-userid="102">
          <div class="photo"><img src="https://i.pravatar.cc/300?img=16" alt=""></div>
          <p class="friend-name">Thiên An</p>
        </a>
        <a class="friend-card" href="#" data-userid="103">
          <div class="photo"><img src="https://i.pravatar.cc/300?img=17" alt=""></div>
          <p class="friend-name">Nguyễn Văn Hưng</p>
        </a>

        <a class="friend-card" href="#" data-userid="104">
          <div class="photo"><img src="https://i.pravatar.cc/300?img=18" alt=""></div>
          <p class="friend-name">Dương Quỳnh Anh</p>
        </a>
        <a class="friend-card" href="#" data-userid="105">
          <div class="photo"><img src="https://i.pravatar.cc/300?img=19" alt=""></div>
          <p class="friend-name">Giang Kim Oanh</p>
        </a>
        <a class="friend-card" href="#" data-userid="106">
          <div class="photo"><img src="https://i.pravatar.cc/300?img=20" alt=""></div>
          <p class="friend-name">Nguyễn Hương</p>
        </a>
      </div>
    </div>

    <!-- POSTS SECTION -->
    <div class="section" id="postsSection">
      <div class="header">
        <h3>Bài viết</h3>
        <button class="btn btn-ghost">Bộ lọc</button>
      </div>

      <!-- sample posts -->
      <div class="post">
        <div class="post-header">
          <img src="https://i.pravatar.cc/100?img=30" alt="">
          <div>
            <div style="font-weight:700">Đỗ Kim Dũng</div>
            <div style="color:var(--muted); font-size:13px">4 tháng 10 · Công khai</div>
          </div>
        </div>

        <div class="post-body">
          <div class="post-text">Ông và các cháu ngày sinh nhật 🎉. Từ Phượng Đỗ Hạnh Đỗ.T. Hương</div>
          <img class="post-img" src="https://images.unsplash.com/photo-1502567008544-7f2a7d3b3b53?q=80&w=1600&auto=format&fit=crop&ixlib=rb-4.0.3&s=ab9b6b8b8d7b6b7c3b4c9e3f8b2f4c2f" alt="">
        </div>

        <div class="post-actions">
          <div><i class="fa-regular fa-thumbs-up"></i> Thích</div>
          <div><i class="fa-regular fa-message"></i> Bình luận</div>
          <div><i class="fa-solid fa-share-from-square"></i> Chia sẻ</div>
        </div>
      </div>

      <div class="post">
        <div class="post-header">
          <img src="https://i.pravatar.cc/100?img=31" alt="">
          <div>
            <div style="font-weight:700">Nguyễn Văn A</div>
            <div style="color:var(--muted); font-size:13px">1 tuần · Bạn bè</div>
          </div>
        </div>

        <div class="post-body">
          <div class="post-text">Một ngày đẹp trời đi chơi biển.</div>
          <img class="post-img" src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=1600&auto=format&fit=crop&ixlib=rb-4.0.3&s=2f2d2f57a9b2e2c2a1b0b2c3d4e5f6a7" alt="">
        </div>

        <div class="post-actions">
          <div><i class="fa-regular fa-thumbs-up"></i> Thích</div>
          <div><i class="fa-regular fa-message"></i> Bình luận</div>
          <div><i class="fa-solid fa-share-from-square"></i> Chia sẻ</div>
        </div>
      </div>

    </div>

  </div> <!-- /wrap -->

  <script>
    // Basic interactivity: tab switch + open profile when clicking a friend card
    (function(){
      const tabs = document.querySelectorAll('.tab');
      const sections = {
        photos: document.getElementById('photosSection'),
        friends: document.getElementById('friendsSection'),
        posts: document.getElementById('postsSection'),
        about: null,
        checkin:null
      };

      function setActive(tabEl){
        tabs.forEach(t=>t.classList.remove('active'));
        tabEl.classList.add('active');

        // show/hide sections (simple mapping)
        const key = tabEl.dataset.tab;
        // hide all primary sections (photos/friends/posts)
        Object.values(sections).forEach(s => { if(s) s.style.display='none' });
        if(key === 'photos') sections.photos.style.display='block';
        else if(key === 'friends') sections.friends.style.display='block';
        else sections.posts.style.display='block';
      }

      tabs.forEach(t=>{
        t.addEventListener('click', (e)=>{
          setActive(t);
          // smooth scroll to that section
          const key = t.dataset.tab;
          if(key === 'photos') document.getElementById('photosSection').scrollIntoView({behavior:'smooth', block:'start'});
          else if(key === 'friends') document.getElementById('friendsSection').scrollIntoView({behavior:'smooth', block:'start'});
          else document.getElementById('postsSection').scrollIntoView({behavior:'smooth', block:'start'});
        });
      });

      // default: show posts + photos + friends are visible by default (we show all sections to allow natural scroll)
      document.querySelectorAll('.tab').forEach(t=>t.classList.remove('active'));
      document.querySelector('.tab[data-tab="posts"]').classList.add('active');

      // click friend card -> open profile (simulate navigation)
      document.getElementById('friendsGrid').addEventListener('click', (e)=>{
        const el = e.target.closest('.friend-card');
        if(!el) return;
        const uid = el.dataset.userid;
        // simulate navigate to /profile/:id (here we'll just alert; in real app do window.location.href)
        alert('Mở profile userId=' + uid + ' (replace with navigation to /profile/'+uid+')');
      });

      // action buttons (just UI demo)
      document.getElementById('profileActions').addEventListener('click', (e)=>{
        const btn = e.target.closest('button');
        if(!btn) return;
        if(btn.classList.contains('btn-primary')) {
          btn.disabled = true;
          btn.innerHTML = '<i class="fa-solid fa-check" style="margin-right:8px"></i>Đã gửi';
          setTimeout(()=>{ btn.disabled=false; btn.innerHTML = '<i class="fa-solid fa-user-plus" style="margin-right:8px"></i>Thêm bạn bè'; }, 1500);
        } else if(btn.textContent.trim().includes('Nhắn tin')) {
          alert('Đi tới Messenger (chưa implement)');
        }
      });

    })();
  </script>

</body>
</html>
