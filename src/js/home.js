
function HomeLibrary()
{
    this.startPage();
}

HomeLibrary.prototype.startPage = function()
{
    this.initializeTooltips();

};

HomeLibrary.prototype.initializeTooltips = function()
{
    //Init Tooltips
    $('[data-toggle="tooltip"]').tooltip();
};

HomeLibrary.prototype.showInvoiceDetails = function()
{
    $("#invoice-details").removeClass('d-none')
        .slideDown();
};

HomeLibrary.prototype.generateInvoice = function()
{
    let companyName = $.trim($("#invoice-customer-full-name").val()),
        charges = parseInt($("#invoice-charges").val(), 10);

    window.location = 'src/scripts/invoice-charges.php?cname='+companyName+'&charges='+charges;
};