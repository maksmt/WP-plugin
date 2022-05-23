<?php get_header();?>


<?php
    $old_events = new WP_Query(array(
        'post_per_page' => -1,
        'post_type' => 'old_events',
    ));

while($old_events->have_posts()){
        $old_events->the_post();?>
<div class="events container">
    <div class="events__body">
        <div class="events__item">
            <div class="events__title">
                <?php the_title(); ?>
            </div>
            <div class="row">
                <div class="row__item">
                    <div class="events__photo">
                        <?php the_post_thumbnail(); ?>
                    </div>
                </div>
                <div class="row__item">
                    <div class="events__text">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
            <div class="events__date">
                <span class="events__date-text">Date of Event:</span>
                <?php $date = get_post_meta($post -> ID, '_event_date', true);?>
            </div>
        </div>
    </div>

    <a href="<?php echo site_url('/old_events') ?>" class="archive-button">Old Events</a>
</div>

<?php
}
wp_reset_postdata();
?>
<div class="calendar container">

    <?php
    echo get_calendar();
    ?>

</div>
<div class="container">
    <div class="calendar">
        <div class="month">
            <div class="prev" onclick="moveDate('prev')">
                <span>&#10094;</span>
            </div>
            <h2 id="month"></h2>
            <p id="date_str"></p>
            <div class="next" onclick="moveDate('next')">
                <span>&#10095;</span>
            </div>
        </div>
        <div class="weekdays">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tue</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>

        </div>
        <div class="days"></div>
    </div>
</div>
<script>
var dt = new Date();

function renderDate() {
    dt.setDate(1);
    var day = dt.getDay();
    var today = new Date();
    var endDate = new Date(
        dt.getFullYear(),
        dt.getMonth() + 1,
        0
    ).getDate();
    var prevDate = new Date(
        dt.getFullYear(),
        dt.getMonth(),
        0
    ).getDate();
    var months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    ]
    document.getElementById("month").innerHTML =
        months[dt.getMonth()];
    document.getElementById("date_str").innerHTML =
        dt.toDateString();
    var cells = "";
    for (x = day; x > 0; x--) {
        cells += "<div class='prev_date'>" + (prevDate - x +
            1) + "</div>";
    }
    console.log(day);
    var d = '<?php echo $date ?>';
    console.log(d);

    for (i = 1; i <= endDate; i++) {
        if (i == today.getDate() && dt.getMonth() ==
            today.getMonth()) {
            cells += "<div class='today'>" + i + "</div>";
        } else {
            cells += "<div class='day '>" + i + "</div>";
        }
        if (i == d) {
            console.log('12312');
        } else {
            cells += "<div class=' post_found'>" + i + "</div>";

        }
    }
    document.getElementsByClassName("days")[0].innerHTML =
        cells;
    // if (!d) {
    //     console.log('date not found');
    // } else {
    //     cells += "<div class='day post_found'>" + i + "</div>";

    // }
}

function moveDate(para) {
    if (para == "prev") {
        dt.setMonth(dt.getMonth() - 1);
    } else if (para == 'next') {
        dt.setMonth(dt.getMonth() + 1);
    }
    renderDate();
}
</script>


<?php get_footer(); ?>