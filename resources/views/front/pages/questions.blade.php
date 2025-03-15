@extends('front.master')
@section('title')
سوالات متداول  
@endsection
@section('body')
   


<nav class="bottom-nav">
    <div class="title-aboutus">
      <p>سوالات متداول از سماط</p>
    </div>
  </nav>

  <div class="container mt-5 mb-5">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a
          class="nav-link activelist"
          id="home-tab"
          data-toggle="tab"
          href="#home"
          role="tab"
          aria-controls="home"
          aria-selected="true"
          >سوالات متداول</a
        >
      </li>
      <li class="nav-item">
        <a
          class="nav-link"
          id="profile-tab"
          data-toggle="tab"
          href="#profile"
          role="tab"
          aria-controls="profile"
          aria-selected="false"
          >حریم خصوصی</a
        >
      </li>
      <li class="nav-item">
        <a
          class="nav-link"
          id="contact-tab"
          data-toggle="tab"
          href="#contact"
          role="tab"
          aria-controls="contact"
          aria-selected="false"
          >قوانین سماط</a
        >
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div
        class="tab-pane fade show activelist"
        id="home"
        role="tabpanel"
        aria-labelledby="home-tab"
      >
        <div class="accordion accordion-flush" id="accordionFlushExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseOne"
                aria-expanded="false"
                aria-controls="flush-collapseOne"
              >
                سماط چه امکانات متفاوتی داره؟
              </button>
            </h2>
            <div
              id="flush-collapseOne"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                وبسایت سفارش غذای رستوران‌سماط با اتصال مستقیم به نرم افزار
                اتوماسیون امکان اشتباهات هنگام ثبت سفارش آنلاین غذا و همچنین
                زمان مورد نیاز برای آماده سازی و تحویل آن را به حداقل ممکن می
                رسونه.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseTwo"
                aria-expanded="false"
                aria-controls="flush-collapseTwo"
              >
                چطور می تونم درسماط حساب کاربری ایجاد کنم؟
              </button>
            </h2>
            <div
              id="flush-collapseTwo"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                خیلی ساده، پس از انتخاب غذای مورد علاقه تان از منوی رستوران،
                هنگام ثبت سفارش با وارد کردن شماره تلفن همراه یک پیامک حاوی کد
                تایید برای شما ارسال و با وارد کردن کد تایید، ثبت نام شما
                تکمیل می شه. یا می تونید در صفحه اصلی سایت روی گزینه ورود کلیک
                کنید.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseThree"
                aria-expanded="false"
                aria-controls="flush-collapseThree"
              >
                سابقه و لیست خریدهای قبلی ام رو کجا ببینم؟
              </button>
            </h2>
            <div
              id="flush-collapseThree"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                با ورود به حساب کاربری و کلیک روی گزینه سفارشات قبلی سابقه
                تمام خریدهای شما نمایش داده می شه.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapse-foure"
                aria-expanded="false"
                aria-controls="flush-collapseThree"
              >
                چه راه هایی برای پرداخت دارم؟
              </button>
            </h2>
            <div
              id="flush-collapse-foure"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                هنگام ثبت سفارش غذا می تونید روش پرداخت دلخواه خودتون رو
                انتخاب کنید. آنلاین و یا نقدی در هنگام تحویل سفارش بصورت
                حضوری.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapsefive"
                aria-expanded="false"
                aria-controls="flush-collapseThree"
              >
                آیا قیمت در منوی وبسایت سماط با قیمت رستوران یکسان است؟
              </button>
            </h2>
            <div
              id="flush-collapsefive"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                بله. قیمت منوی وبسایت سماط دقیقا مطابق با قیمت منویرستوران است
                و در صورت تغییر قیمت از طرف رستوران این تغییر در وبسایت سماط
                بلافاصله قابل مشاهده است.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapsesix"
                aria-expanded="false"
                aria-controls="flush-collapseThree"
              >
                چطور می تونم از اعتبار هدیه و تخفیف استفاده کنم؟
              </button>
            </h2>
            <div
              id="flush-collapsesix"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                برای استفاده از کد تخفیف میتونید به سادگی کد رو در سبد خرید،
                در قسمت مشخص شده وارد کنید. اعتبار هدیه هنگام انتخاب روش
                پرداخت برای شما نمایش داده میشه و در صورت تمایل میتونید ازش
                استفاده کنید.
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        class="tab-pane fade"
        id="profile"
        role="tabpanel"
        aria-labelledby="profile-tab"
      >
        <div class="accordion accordion-flush" id="accordionFlushExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseOne"
                aria-expanded="false"
                aria-controls="flush-collapseOne"
              >
                حریم خصوصی
              </button>
            </h2>
            <div
              id="flush-collapseOne"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                سماط متعهد می‌شود حریم خصوصی شما را حفظ کند و به آن احترام
                بگذارد. بخش «حریم خصوصی» روش‌های استفاده از اطلاعات شخصی
                کاربران در این وب سایت را شرح می‌دهد. اگر برای سفارش غذای خوب
                از خدمات ما استفاده می‌کنید، سیاست‌های حفظ حریم خصوصی وب‌سایت
                سماط ، در مورد شما صدق می‌کند. پردازش و آماده سازی سفارش‌ها
                نیازمند اطلاعات دقیق کاربران است؛ برای این‌که بتوانیم خدمات
                مطلوب‌تری به شما ارائه دهیم، ممکن است به هنگام خرید، ثبت نظر و
                استفاده از برخی امکانات سایت، به اطلاعات شما نیاز داشته باشیم؛
                هم‌چنین سماط برای ارتباط با مشتریان، بهبود رابط کاربری،
                بهینه‌سازی محتوا و تحقیقات بازاریابی، بایستی از اطلاعات
                کاربران خود استفاده کند. این در حالی است که اطلاع‌رسانی خدمات
                جدید و سرویس‌های ویژه یا پروموشن‌ها، اخبار و رویدادها با ارسال
                ایمیل یا پیامک به کاربران انجام می‌شود.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseTwo"
                aria-expanded="false"
                aria-controls="flush-collapseTwo"
              >
                چه اطلاعاتی را گردآوری می‌کنیم؟
              </button>
            </h2>
            <div
              id="flush-collapseTwo"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                اطلاعاتی که درباره‌ی شما گردآوری و نگه‌داری می‌کنیم، ممکن است
                شامل موارد زیر باشد: نام و نام خانوادگی شما شماره تلفن همراه
                تاریخ تولد نشانی‌های مورد نظر برای تحویل سفارش‌ها اطلاعات
                دیگری که شما برای ما نوشته‌اید یا از راه‌های دیگر در اختیار ما
                قرار داده‌اید.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseThree"
                aria-expanded="false"
                aria-controls="flush-collapseThree"
              >
                چگونه اطلاعات شما را گردآوری می‌کنیم؟
              </button>
            </h2>
            <div
              id="flush-collapseThree"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                از شما تقاضا خواهیم کرد اطلاعات خود را در اختیار ما قرار دهید؛
                هنگامی‌که:به‌شکل کاربر مهمان غذا سفارش می‌دهید. در وب‌سایت
                سماط یک حساب کاربری ایجاد می‌کنید.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseseven"
                aria-expanded="false"
                aria-controls="flush-collapseThree"
              >
                چرا به شماره تلفن شما نیاز داریم؟
              </button>
            </h2>
            <div
              id="flush-collapseseven"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                برای ثبت نام در وب‌سایت سماط باید نخست شماره موبایل خود را
                وارد کنید تا کد فعال‌سازی برای شما ارسال شود. شماره تلفن همراه
                شما نقش نام کاربری را ایفا می‌کند. ممکن است به هر دلیل رمز
                عبور خود را فراموش کنید؛ در این موقعیت، می‌توانید از تلفن
                همراه خود کد فعال‌سازی مجدد دریافت کنید. ممکن است برای آگاه
                کردن شما از اخبار و تغییرات جدید از شماره همراهتان استفاده
                کنیم؛ مانند، اطلاع‌رسانی از تغییر شیوه‌ی دسترسی شما به خدمات
                آنلاین ما، یا خدمات جدید و پیشنهادهای خاص.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseeght"
                aria-expanded="false"
                aria-controls="flush-collapseThree"
              >
                فعالیت‌های مرورگر شما در هنگام بازدید از وب‌سایت سماط
              </button>
            </h2>
            <div
              id="flush-collapseeght"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                هنگامی‌که شما از وب‌سایت سماط استفاده می‌کنید، ما اطلاعاتی
                درباره‌ی فعالیت‌های شما گردآوری می‌کنیم که برخی از این اطلاعات
                عبارتند از: نشانی آی. پی. کامپیوتر شما (این نشانی یک شماره‌ی
                دیجیتالی ۱۲ رقمی منحصربه‌فرد است که برنامه‌های اینترنتی
                به‌وسیله‌ی آن کامپیوتر را شناسایی و با آن ارتباط برقرار
                می‌کنند). نوع مرورگری که شما استفاده می‌کنید (مرورگر برنامه‌ای
                است که شما برای دیدن وب‌سایت‌ها از آن استفاده می‌کنید؛ مانند
                Internet Explorer، Firefox، Safari، Google Chrome). زمانی‌که
                شما وارد وب‌سایت شده‌اید و مدت زمانی که از وب‌سایت استفاده
                کرده‌اید. URL مرجع شما (سایتی که شما برای دسترسی و ورود به
                وب‌سایت ما از آن استفاده کرده‌اید). ما با استفاده از این
                اطلاعات نمی‌توانیم شما را شناسایی کنیم، بلکه این اطلاعات را از
                تعداد بسیار بازدیدکنندگان سایت‌مان گردآوری و آن‌ها را تحلیل
                می‌کنیم؛ با استفاده از این اطلاعات، می‌توانیم بفهمیم که کابران
                چگونه از وب‌سایت ما استفاده می‌کنند و فهمیدن این موضوع به ما
                کمک می‌کند خدمات بهتری به آنان ارائه دهیم.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapsefive"
                aria-expanded="false"
                aria-controls="flush-collapseThree"
              >
                استفاده از کوکی‌ها و دستگاه‌های ذخیره‌سازی دیگر
              </button>
            </h2>
            <div
              id="flush-collapsefive"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                کوکی‌ها فایل‌های اطلاعاتی هستند که روی کامپیوتر شما ذخیره
                می‌شوند تا به وب‌سایت‌ها کمک کنند شما را به خاطر بیاورند. ما و
                همکاران‌مان، با استفاده از کوکی‌ها اطلاعاتی درباره شیوه‌ی
                استفاده شما از وب‌سایت‌مان گردآوری می‌کنیم؛ این اطلاعات ما را
                در بهبود رابط کاربری و محتوای سایت کمک خواهد کرد. شما نیز به
                وسیله‌ی ثبت و ذخیره‌سازی این کوکی‌ها، هنگام ورود مجدد به سایت،
                نیازی به ثبت مجدد نام کاربری و کلمه‌ی عبور نخواهید داشت.
                هم‌چنین ما به وسیله‌ی کوکی‌ها، آخرین وضعیت سفارش روز شما را
                ذخیره می‌کنیم تا شما بتوانید آن‌ها را در پروفایل خود مشاهده
                کنید.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapsesix"
                aria-expanded="false"
                aria-controls="flush-collapseThree"
              >
                اطلاعات بیشتر
              </button>
            </h2>
            <div
              id="flush-collapsesix"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                در مجموعه‌ی سماط، حفظ امنیت اطلاعات شخصی شما را امری بسیار جدی
                و مهم می‌دانیم و در وب‌سایت خود از سیاست‌های امنیتی و
                فناوری‌هایی استفاده می‌کنیم که برای محافظت از اطلاعات شخصی
                طراحی شده‌اند؛ هم‌چنین از روش‌ها و دستورالعمل‌های امنیتی سختی
                که قوانین حفظ حریم خصوصی کاربران به آن‌ها نیاز دارد، پیروی
                می‌کنیم. این روش‌های محافظتی ذخیره‌سازی، استفاده و انتشار
                همه‌ی اطلاعات شما را دربر می‌گیرد و از دسترسی و استفاده‌ی
                غیرمجاز از این اطلاعات جلوگیری می‌کند.
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        class="tab-pane fade"
        id="contact"
        role="tabpanel"
        aria-labelledby="contact-tab"
      >
        <div class="accordion accordion-flush" id="accordionFlushExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseOne"
                aria-expanded="false"
                aria-controls="flush-collapseOne"
              >
                قوانین عمومی
              </button>
            </h2>
            <div
              id="flush-collapseOne"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                حقوق مشتریان: تمامی مشتریان حق دارند از کیفیت بالای غذا و
                خدمات بهره‌مند شوند و در صورت هرگونه نارضایتی، نظرات و شکایات
                خود را به مدیریت رستوران اعلام کنند.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseTwo"
                aria-expanded="false"
                aria-controls="flush-collapseTwo"
              >
                تعریف مشتری یا کاربر
              </button>
            </h2>
            <div
              id="flush-collapseTwo"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                مشتری یا کاربر به شخصی گفته می‌شود که با اطلاعات کاربری خود که
                در فرم ثبت‌نام درج کرده است، به ثبت سفارش یا هرگونه استفاده از
                خدمات سماط اقدام کند.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#flush-collapseThree"
                aria-expanded="false"
                aria-controls="flush-collapseThree"
              >
                قوانین استفاده از خدمات رستوران سماط
              </button>
            </h2>
            <div
              id="flush-collapseThree"
              class="accordion-collapse collapse"
              data-bs-parent="#accordionFlushExample"
            >
              <div class="accordion-body">
                مسئولیت وارد کردن اطلاعات اشتباه و غیر واقعی از قبیل نام و
                نام‌خانوادگی، آدرس و شماره تماس به عهده کاربر است.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="./app.js"></script>
  @endsection
