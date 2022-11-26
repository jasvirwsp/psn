
// Invoice markup
// Author: Max Kostinevich
// BETA (no styles)
// http://pdfmake.org/playground.html
// playground requires you to assign document definition to a variable called dd


var dd = {


   header: {
    columns: [
      { text: 'HEADER LEFT', style: 'documentHeaderLeft' },
      { text: 'HEADER CENTER', style: 'documentHeaderCenter' },
      { text: 'HEADER RIGHT', style: 'documentHeaderRight' }
    ]
  },
  footer: {
    columns: [
      { text: 'FOOTER LEFT', style: 'documentFooterLeft' },
      { text: 'FOOTER CENTER', style: 'documentFooterCenter' },
      { text: 'FOOTER RIGHT', style: 'documentFooterRight' }
    ]
  },
	content: [
	    // Header
	    {
	        columns: [
	            {
                    image: 'logo_url',
                    width: 150
	            },
	                
	            [
	                {
	                    text: 'INVOICE', 
	                    style: 'invoiceTitle',
	                    width: '*'
	                },
    	            {
    	              stack: [
    	                   {
    	                       columns: [
    	                            {
    	                                text:'Invoice #', 
    	                                style:'invoiceSubTitle',
    	                                width: '*'
    	                                
    	                            }, 
    	                            {
    	                                text:'00001',
    	                                style:'invoiceSubValue',
    	                                width: 100
    	                                
    	                            }
    	                            ]
    	                   },
    	                   {
    	                       columns: [
    	                           {
    	                               text:'Date Issued',
    	                               style:'invoiceSubTitle',
    	                               width: '*'
    	                           }, 
    	                           {
    	                               text:'June 01, 2016',
    	                               style:'invoiceSubValue',
    	                               width: 100
    	                           }
    	                           ]
    	                   },
    	                   {
    	                       columns: [
    	                           {
    	                               text:'Due Date',
    	                               style:'invoiceSubTitle',
    	                               width: '*'
    	                           }, 
    	                           {
    	                               text:'June 05, 2016',
    	                               style:'invoiceSubValue',
    	                               width: 100
    	                           }
    	                           ]
    	                   },
    	               ]
    	            }
	            ],
	        ],
	    },
	    // Billing Headers
	    {
	        columns: [
	            {
	                text: 'Billing From',
	                style:'invoiceBillingTitle',
	                
	            },
	            {
	                text: 'Billing To',
	                style:'invoiceBillingTitle',
	                
	            },
	        ]
	    },
	    // Billing Details
	    {
	        columns: [
	            {
	                text: 'Your Name \n Your Company Inc.',
	                style: 'invoiceBillingDetails'
	            },
	            {
	                text: 'Client Name \n Client Company',
	                style: 'invoiceBillingDetails'
	            },
	        ]
	    },
	    // Billing Address Title
	    {
	        columns: [
	            {
	                text: 'Address',
	                style: 'invoiceBillingAddressTitle'
	            },
	            {
	                text: 'Address',
	                style: 'invoiceBillingAddressTitle'
	            },
	        ]
	    },
	    // Billing Address
	    {
	        columns: [
	            {
	                text: '9999 Street name 1A \n New-York City NY 00000 \n   USA',
	                style: 'invoiceBillingAddress'
	            },
	            {
	                text: '1111 Other street 25 \n New-York City NY 00000 \n   USA',
	                style: 'invoiceBillingAddress'
	            },
	        ]
	    },
        // Line breaks
	    '\n\n',
	    // Items
        {
          table: {
            // headers are automatically repeated if the table spans over multiple pages
            // you can declare how many rows should be treated as headers
            headerRows: 1,
            widths: [ '*', 40, 'auto', 40, 'auto', 80 ],
    
            body: [
              // Table Header
              [ 
                  {
                      text: 'Product',
                      style: 'itemsHeader'
                  }, 
                  {
                      text: 'Qty',
                      style: [ 'itemsHeader', 'center']
                  }, 
                  {
                      text: 'Price',
                      style: [ 'itemsHeader', 'center']
                  }, 
                  {
                      text: 'Tax',
                      style: [ 'itemsHeader', 'center']
                  }, 
                  {
                      text: 'Discount',
                      style: [ 'itemsHeader', 'center']
                  }, 
                  {
                      text: 'Total',
                      style: [ 'itemsHeader', 'center']
                  } 
              ],
              // Items
              // Item 1
              [ 
                  [
                      {
                          text: 'Item 1',
                          style:'itemTitle'
                      },
                      {
                          text: 'Item Description',
                          style:'itemSubTitle'
                          
                      }
                  ], 
                  {
                      text:'1',
                      style:'itemNumber'
                  }, 
                  {
                      text:'$999.99',
                      style:'itemNumber'
                  }, 
                  {
                      text:'0%',
                      style:'itemNumber'
                  }, 
                  {
                      text: '0%',
                      style:'itemNumber'
                  },
                  {
                      text: '$999.99',
                      style:'itemTotal'
                  } 
              ],
              // Item 2
              [ 
                  [
                      {
                          text: 'Item 2',
                          style:'itemTitle'
                      }, 
                      {
                          text: 'Item Description',
                          style:'itemSubTitle'
                          
                      }
                  ], 
                  {
                      text:'1',
                      style:'itemNumber'
                  }, 
                  {
                      text:'$999.99',
                      style:'itemNumber'
                  }, 
                  {
                      text:'0%',
                      style:'itemNumber'
                  }, 
                  {
                      text: '0%',
                      style:'itemNumber'
                  },
                  {
                      text: '$999.99',
                      style:'itemTotal'
                  } 
              ],
              // END Items
            ]
          }, // table
        //  layout: 'lightHorizontalLines'
        },
     // TOTAL
        {
          table: {
            // headers are automatically repeated if the table spans over multiple pages
            // you can declare how many rows should be treated as headers
            headerRows: 0,
            widths: [ '*', 80 ],
    
            body: [
              // Total
              [ 
                  {
                      text:'Subtotal',
                      style:'itemsFooterSubTitle'
                  }, 
                  { 
                      text:'$2000.00',
                      style:'itemsFooterSubValue'
                  }
              ],
              [ 
                  {
                      text:'Tax 21%',
                      style:'itemsFooterSubTitle'
                  },
                  {
                      text: '$523.13',
                      style:'itemsFooterSubValue'
                  }
              ],
              [ 
                  {
                      text:'TOTAL',
                      style:'itemsFooterTotalTitle'
                  }, 
                  {
                      text: '$2523.93',
                      style:'itemsFooterTotalValue'
                  }
              ],
            ]
          }, // table
          layout: 'lightHorizontalLines'
        },
	    // Signature
	    {
	        columns: [
	            {
	                text:'',
	            },
	            {
	                stack: [
	                    { 
	                        text: '_________________________________',
	                        style:'signaturePlaceholder'
	                    },
	                    { 
	                        text: 'Your Name',
	                        style:'signatureName'
	                        
	                    },
	                    { 
	                        text: 'Your job title',
	                        style:'signatureJobTitle'
	                        
	                    }
	                    ],
	               width: 180
	            },
	        ]
	    },
        { 
            text: 'NOTES',
            style:'notesTitle'
        },
        { 
            text: 'Some notes goes here \n Notes second line',
            style:'notesText'
        }
	],
	styles: {
	    // Document Header
	    documentHeaderLeft: {
	        fontSize: 10,
	        margin: [5,5,5,5],
	        alignment:'left'
	    },
	    documentHeaderCenter: {
	        fontSize: 10,
	        margin: [5,5,5,5],
	        alignment:'center'
	    },
	    documentHeaderRight: {
	        fontSize: 10,
	        margin: [5,5,5,5],
	        alignment:'right'
	    },
	    // Document Footer
	    documentFooterLeft: {
	        fontSize: 10,
	        margin: [5,5,5,5],
	        alignment:'left'
	    },
	    documentFooterCenter: {
	        fontSize: 10,
	        margin: [5,5,5,5],
	        alignment:'center'
	    },
	    documentFooterRight: {
	        fontSize: 10,
	        margin: [5,5,5,5],
	        alignment:'right'
	    },
	    // Invoice Title
		invoiceTitle: {
			fontSize: 22,
			bold: true,
			alignment:'right',
			margin:[0,0,0,15]
		},
		// Invoice Details
		invoiceSubTitle: {
			fontSize: 12,
			alignment:'right'
		},
		invoiceSubValue: {
			fontSize: 12,
			alignment:'right'
		},
		// Billing Headers
		invoiceBillingTitle: {
			fontSize: 14,
			bold: true,
			alignment:'left',
			margin:[0,20,0,5],
		},
		// Billing Details
		invoiceBillingDetails: {
			alignment:'left'

		},
		invoiceBillingAddressTitle: {
		    margin: [0,7,0,3],
		    bold: true
		},
		invoiceBillingAddress: {
		    
		},
		// Items Header
		itemsHeader: {
		    margin: [0,5,0,5],
		    bold: true
		},
		// Item Title
		itemTitle: {
		    bold: true,
		},
		itemSubTitle: {
            italics: true,
            fontSize: 11
		},
		itemNumber: {
		    margin: [0,5,0,5],
		    alignment: 'center',
		},
		itemTotal: {
		    margin: [0,5,0,5],
		    bold: true,
		    alignment: 'center',
		},

		// Items Footer (Subtotal, Total, Tax, etc)
		itemsFooterSubTitle: {
		    margin: [0,5,0,5],
		    bold: true,
		    alignment:'right',
		},
		itemsFooterSubValue: {
		    margin: [0,5,0,5],
		    bold: true,
		    alignment:'center',
		},
		itemsFooterTotalTitle: {
		    margin: [0,5,0,5],
		    bold: true,
		    alignment:'right',
		},
		itemsFooterTotalValue: {
		    margin: [0,5,0,5],
		    bold: true,
		    alignment:'center',
		},
		signaturePlaceholder: {
		    margin: [0,70,0,0],   
		},
		signatureName: {
		    bold: true,
		    alignment:'center',
		},
		signatureJobTitle: {
		    italics: true,
		    fontSize: 10,
		    alignment:'center',
		},
		notesTitle: {
		  fontSize: 10,
		  bold: true,  
		  margin: [0,50,0,3],
		},
		notesText: {
		  fontSize: 10
		},
		center: {
		    alignment:'center',
		},
	},
	defaultStyle: {
		columnGap: 20,
	}
}