<script>
        function generate() {
        var test = <?php echo json_encode($data); ?>;
        var resume = <?php echo json_encode($Resume); ?>;
        var date = "<?php echo date("d/m/Y");?>";
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
                                    text : 'Tanggal Produksi',
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
                                    text : 'Jumlah',
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
                                    text : 'Kontaminasi',
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
                                    text : 'Panen',
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
                                    text : 'Sisa',
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
                                    text : 'Lokasi',
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
                                    text : 'Data Baglog',
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
                                    text : 'Passed',
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
                                    text : 'Reject',
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

                            children: [new docx.Paragraph(test[{{$i}}]['TanggalProduksi'])],
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
                            children: [new docx.Paragraph(test[{{$i}}]['JumlahKontaminasi'].toString())],
                        }),
                        new docx.TableCell({
                            width: {
                                size: 3505,
                                type: docx.WidthType.DXA,
                            },
                            children: [new docx.Paragraph(test[{{$i}}]['InStock'].toString())],
                        }),
                        new docx.TableCell({
                            width: {
                                size: 3505,
                                type: docx.WidthType.DXA,
                            },
                            children: [new docx.Paragraph((test[{{$i}}]['Passed']+test[{{$i}}]['Reject']).toString())],
                        }),
                        new docx.TableCell({
                            width: {
                                size: 3505,
                                type: docx.WidthType.DXA,
                            },
                            children: [new docx.Paragraph((test[{{$i}}]['JumlahBaglog']+test[{{$i}}]['JumlahKontaminasi']).toString())],
                        }),
                        new docx.TableCell({
                            width: {
                                size: 3505,
                                type: docx.WidthType.DXA,
                            },
                            children: [new docx.Paragraph(test[{{$i}}]['Lokasi'])],
                        }),
                        new docx.TableCell({
                            width: {
                                size: 3505,
                                type: docx.WidthType.DXA,
                            },
                            children: [new docx.Paragraph(test[{{$i}}]['ContaminationRate'].toString() + '%')],
                        }),
                        new docx.TableCell({
                            width: {
                                size: 3505,
                                type: docx.WidthType.DXA,
                            },
                            children: [new docx.Paragraph(test[{{$i}}]['BaglogDetails'])],
                        }),
                        new docx.TableCell({
                            width: {
                                size: 3505,
                                type: docx.WidthType.DXA,
                            },
                            children: [new docx.Paragraph(test[{{$i}}]['Passed'].toString())],
                        }),
                        new docx.TableCell({
                            width: {
                                size: 3505,
                                type: docx.WidthType.DXA,
                            },
                            children: [new docx.Paragraph(test[{{$i}}]['Reject'].toString())],
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
                text : 'Mylea Production Report',
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
                    text : 'Total Produksi Mylea \t: ' + resume['Produksi'],
                    break: 1,
                  }),
                  new docx.TextRun({
                    text : 'Total Kontaminasi Mylea \t: ' + resume['Kontaminasi'],
                    break: 1,
                  }),
                  new docx.TextRun({
                    text : 'Success Rate \t\t: ' + resume['SuccessRate'] +'%',
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
          saveAs(blob, "ReportMylea_<?php echo $_GET['TanggalAwal'].'_'.$_GET['TanggalAkhir'];?>.docx");
          console.log("Document created successfully");
          console.log(test[0]['JumlahBaglog']);
        });
    };
</script>