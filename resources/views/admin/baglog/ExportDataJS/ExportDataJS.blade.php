<script>
    function generate() {
    var test = <?php echo json_encode($data); ?>;
    var date = "<?php echo date("d/m/Y");?>";
    for(var i  = 0; i < test.length; i++){
        if(test[i]['TanggalBibit'] == null){
            test[i]['TanggalBibit'] = '-';
            test[i]['JumlahBibit'] = 0;
        }
    }
    var resume = <?php echo json_encode($Resume); ?>;
    const table = new docx.Table({
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
                                text : 'Kode Produksi',
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
                                text : 'Tanggal Pembibitan',
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
                                text : 'Jumlah Baglog',
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
                                text : 'Jumlah Kontaminasi',
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
                                text : 'Tanggal Kontaminasi',
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
                                text : 'Contamination Rate',
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
                                text : 'Harvested Baglog',
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
                                text : 'In Stock',
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
                                text : 'Tanggal Bibit',
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
                                text : 'Jumlah Bibit',
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
                                text : 'Keterangan Bibit',
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
                        children: [new docx.Paragraph(test[{{$i}}]['KodeProduksi'])],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },

                        children: [new docx.Paragraph(test[{{$i}}]['TanggalPembibitan'])],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph(test[{{$i}}]['JumlahBaglog'].toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph(test[{{$i}}]['Kontaminasi'].toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph(test[{{$i}}]['TanggalKontaminasi'])],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph(test[{{$i}}]['ContaminationRate'])],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph((test[{{$i}}]['InStock']).toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph((test[{{$i}}]['InStock'] - test[{{$i}}]['Pemakaian']).toString())],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph(test[{{$i}}]['TanggalBibit'])],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph(test[{{$i}}]['JumlahBibit'])],
                    }),
                    new docx.TableCell({
                        width: {
                            size: 3505,
                            type: docx.WidthType.DXA,
                        },
                        children: [new docx.Paragraph(test[{{$i}}]['KeteranganBibit'].toString())],
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
            text : 'Baglog Production Report',
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
                text : 'Total Produksi Baglog\t\t: ' + resume['Produksi'],
                break: 1,
              }),
              new docx.TextRun({
                text : 'Total Kontaminasi Baglog \t: ' + resume['Kontaminasi'],
                break: 1,
              }),
              new docx.TextRun({
                text : 'Success Rate \t\t\t: ' + resume['SuccessRate'] +'%',
                break: 1,
              }),
            ],
          }),
          new docx.Paragraph({
            children: [
                new docx.TextRun({
                text : '',
              }),
            ],
          }),
          table,
          new docx.Paragraph({
            children: [
                new docx.TextRun({
                text : '',
                break : 2,
              }),
            ],
          }),
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
      saveAs(blob, "ReportBaglog_<?php echo $_GET['TanggalAwal'].'_'.$_GET['TanggalAkhir'];?>.docx");
      console.log("Document created successfully");
      console.log(test[0]['JumlahBaglog']);
    });
};
</script>