var NilaaOpcheckout = Class.create(Checkout, {
    initialize: function($super,accordion, urls){
        $super(accordion, urls);
        //New Code Addded
        this.steps = ['login','billing', 'shipping', 'review', 'payment'];
    }
});