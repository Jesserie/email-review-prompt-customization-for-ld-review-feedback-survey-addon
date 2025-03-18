function only_course_completed_review_prompt() {
    if ( class_exists( 'ns_wdm_ld_course_review\Review_Prompt_Email' ) ) {
        $class_instance = ns_wdm_ld_course_review\Review_Prompt_Email::get_instance();

        // Remove actions for lesson, topic, quiz completion, and course access updates.
        remove_action( 'learndash_lesson_completed', array( $class_instance, 'check_if_review_prompt_mail_criteria_met' ), 5, 1 );
        remove_action( 'learndash_topic_completed', array( $class_instance, 'check_if_review_prompt_mail_criteria_met' ), 5, 1 );
        remove_action( 'learndash_quiz_completed', array( $class_instance, 'handle_review_criteria_separately_on_quiz' ), 5, 2 );
        remove_action( 'learndash_update_course_access', array( $class_instance, 'handle_review_criteria_separately_on_enrollment' ), 5, 4 );
    }
}
add_action( 'init', 'only_course_completed_review_prompt', 100 );
