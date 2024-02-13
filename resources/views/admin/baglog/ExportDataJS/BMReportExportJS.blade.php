<script>
    window.export.onclick = function() {
        var test = <?php echo json_encode($data); ?>;
        var date = "<?php echo date("d/m/Y");?>";
    for(var i  = 0; i < test.length; i++){
    }
    var resume = <?php echo json_encode($Resume); ?>;
    const table_order = new docx.Table({
        alignment: docx.AlignmentType.CENTER,
        rows: [
            new docx.TableRow({
                tableHeader: true,
                children: [
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Weight per Bag',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Total Bags',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'No Kontainer S. Kayu',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'MC',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'No Recipe',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Tanggal Keluar Resep',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'CaCO3 (kg)',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Sawdust (kg)',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Pollard',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Tapioka (kg)',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Water (kg)',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Kali Resep Terpakai',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Jumlah Produksi Baglog',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                ],
            }),
        <?php for($i = 0; $i < count($data); $i++){?>
            new docx.TableRow({
                children: [
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph(test[{{$i}}]['WeightperBag'].toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },

                        children: [new docx.Paragraph(test[{{$i}}]['TotalBags'].toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph(test[{{$i}}]['Bahan']['NoKontSKayu'].toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph((Math.round(test[{{$i}}]['Bahan']['MCSKayu'])/100).toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph(test[{{$i}}]['NoRecipe'])],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph(test[{{$i}}]['TanggalKeluar'])],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph((Math.round(test[{{$i}}]['Bahan']['CaCO3']*1000)/1000).toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph((Math.round(test[{{$i}}]['Bahan']['SKayu']*1000)/1000).toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph((Math.round(test[{{$i}}]['Bahan']['Pollard']*1000)/1000).toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph((Math.round(test[{{$i}}]['Bahan']['Tapioka']*1000)/1000).toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph((Math.round(test[{{$i}}]['Bahan']['Air']*1000)/1000).toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph(test[{{$i}}]['KaliTerpakai'].toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph((test[{{$i}}]['TotalBags']*test[{{$i}}]['KaliTerpakai']).toString())],
                    }),
                ],
            }),
        <?php }?>
        ],
    });

    const table_actual = new docx.Table({
        alignment: docx.AlignmentType.CENTER,
        rows: [
            new docx.TableRow({
                tableHeader: true,
                children: [
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Weight per Bag',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Total Bags',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'No Kontainer S. Kayu',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'MC',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'No Recipe',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Tanggal Keluar Resep',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Kali Resep Terpakai',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Jumlah Produksi Baglog',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Tanggal Mixing',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'CaCO3 (kg)',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Sawdust (kg)',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Pollard',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Tapioka (kg)',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                    new docx.TableCell({
                        children: [new docx.Paragraph({
                            alignment : docx.AlignmentType.CENTER,
                            children: [
                            new docx.TextRun({
                                text : 'Water (kg)',
                                bold : true,
                            }),
                            ],
                        })],
                    }),
                ],
            }),
        <?php for($i = 0; $i < count($data); $i++){?>
            new docx.TableRow({
                children: [
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph(test[{{$i}}]['WeightperBag'].toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },

                        children: [new docx.Paragraph(test[{{$i}}]['TotalBags'].toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph(test[{{$i}}]['Bahan']['NoKontSKayu'].toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph((Math.round(test[{{$i}}]['Bahan']['MCSKayu'])/100).toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph(test[{{$i}}]['NoRecipe'])],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph(test[{{$i}}]['TanggalKeluar'])],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph(test[{{$i}}]['KaliTerpakai'].toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph((test[{{$i}}]['TotalBags']*test[{{$i}}]['KaliTerpakai']).toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph((test[{{$i}}]['TanggalMixing']))],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph((Math.round(test[{{$i}}]['Bahan']['CaCO3']*test[{{$i}}]['KaliTerpakai']*1000)/1000).toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph((Math.round(test[{{$i}}]['Bahan']['SKayu']*test[{{$i}}]['KaliTerpakai']*1000)/1000).toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph((Math.round(test[{{$i}}]['Bahan']['Pollard']*test[{{$i}}]['KaliTerpakai']*1000)/1000).toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph((Math.round(test[{{$i}}]['Bahan']['Tapioka']*test[{{$i}}]['KaliTerpakai']*1000)/1000).toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph((Math.round(test[{{$i}}]['Bahan']['Air']*test[{{$i}}]['KaliTerpakai']*1000)/1000).toString())],
                    }),
                ],
            }),
        <?php }?>
        ],
    });

    const doc = new docx.Document({
      sections: [{
        properties: {
            page: {
                size: {
                    orientation: docx.PageOrientation.LANDSCAPE,
                },
            },
            titlePage: true,
        },
        children: [
          new docx.Paragraph({
            text : 'Baglog Making Report',
            heading: docx.HeadingLevel.TITLE,
            alignment: docx.AlignmentType.CENTER,
          }),
          new docx.Paragraph({
            text : 'Resume :',
            heading: docx.HeadingLevel.HEADING_1,
          }),
          new docx.Paragraph({
            children: [
              new docx.TextRun({
                text : 'Total Produksi Baglog\t: ' + resume['TotalBaglog'],
                bold : true,
                break: 1,
              }),
              new docx.TextRun({
                text : 'Total Pemakaian Bahan',
                bold : true,
                break: 1,
              }),
              new docx.TextRun({
                text : 'CaCO3 \t\t: ' + (Math.round(resume['CaCO3']*1000)/1000).toString(),
                break: 1,
              }),
              new docx.TextRun({
                text : 'Serbuk Kayu \t: ' + (Math.round(resume['SKayu']*1000)/1000).toString(),
                break: 1,
              }),
              new docx.TextRun({
                text : 'Pollard \t\t: ' + (Math.round(resume['Pollard']*1000)/1000).toString(),
                break: 1,
              }),
              new docx.TextRun({
                text : 'Tapioka \t\t: ' + (Math.round(resume['Tapioka']*1000)/1000).toString(),
                break: 1,
              }),
              new docx.TextRun({
                text : 'Air \t\t: ' + (Math.round(resume['Air']*1000)/1000).toString(),
                break: 1,
              }),
            ],
          }),
          new docx.Paragraph({
            text : 'Order Report',
            heading: docx.HeadingLevel.HEADING_1,
            alignment: docx.AlignmentType.CENTER,
            break: 2,
          }),
          table_order,
          new docx.Paragraph({
            children: [
              new docx.TextRun({
                text : '',
                bold : true,
                break: 3,
              }),
            ],
          }),
          new docx.Paragraph({
            text : 'Actual Report',
            heading: docx.HeadingLevel.HEADING_1,
            alignment: docx.AlignmentType.CENTER,
            break: 2,
          }),
          table_actual,
          new docx.Paragraph({
            children: [
                new docx.TextRun({
                text : date + '\t',
                break : 2,
              }),
            ],
            alignment: docx.AlignmentType.RIGHT,
          }),
          new docx.Paragraph({
            children: [
                new docx.TextRun({
                text : 'Production Manager' + '\t',
                break : 5,
              }),
            ],
            alignment: docx.AlignmentType.RIGHT,
          }),
        ],
      }]
    });
    docx.Packer.toBlob(doc).then(blob => {
      console.log(blob);
      saveAs(blob, "BaglogMakingReport_<?php echo $_GET['TanggalAwal'].'_'.$_GET['TanggalAkhir'];?>.docx");
      console.log("Document created successfully");
      console.log(test[0]['JumlahBaglog']);
    });
    };
</script>